<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    /**
     * MENU LIST PAGE
     */
    public function index(Request $request)
    {
        $q = $request->query('q', null);
        $group = $request->query('group', null);
        $categoryParam = $request->query('category', null);

        // Ambil kategori
        if (class_exists(Category::class)) {
            $allCategories = Category::orderBy('name')->get();
            $groups = $allCategories->pluck('group')->unique()->filter()->values();
        } else {
            $names = Menu::select('category')->distinct()->pluck('category')->filter()->values();
            $allCategories = $names->map(fn($n) => (object)[
                'id' => $n, 'name' => $n, 'group' => null
            ]);
            $groups = collect();
        }

        // Subkategori (hanya muncul jika group dipilih)
        if ($group && $groups->isNotEmpty()) {
            $subCategories = $allCategories->filter(
                fn($c) => $c->group == $group
            )->values();
        } else {
            $subCategories = collect(); // kosong
        }

        // Query Menu
        $menusQuery = Menu::query()->with('category');

        // Search
        if ($q) {
            $menusQuery->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%");
            });
        }

        // Filter kategori
        if ($categoryParam && class_exists(Category::class)) {

            if (is_numeric($categoryParam)) {
                $menusQuery->where('category_id', (int)$categoryParam);

            } else {
                $cat = Category::where('slug', $categoryParam)
                               ->orWhere('name', $categoryParam)
                               ->first();

                if ($cat) {
                    $menusQuery->where('category_id', $cat->id);
                }
            }

        } elseif ($group) {
            $idsInGroup = $allCategories->filter(
                fn($c) => $c->group == $group
            )->pluck('id')->toArray();

            if (!empty($idsInGroup)) {
                $menusQuery->whereIn('category_id', $idsInGroup);
            }
        }

        // Pagination
        $menus = $menusQuery->orderBy('created_at', 'desc')
                            ->paginate(12)
                            ->withQueryString();

        return view('titiper.menu.index', [
            'menus'         => $menus,
            'categories'    => $allCategories,
            'groups'        => $groups,
            'subCategories' => $subCategories,
            'q'             => $q,
            'group'         => $group,
            'category'      => $categoryParam,
        ]);
    }

    /**
     * DETAIL MENU PAGE
     */
    public function show($menuId)
    {
        // findOrFail agar otomatis 404 jika tidak ditemukan
        $menu = Menu::with('category')->findOrFail($menuId);

        // Fallback rating & estimasi waktu
        $rating = $menu->rating ?? 4.8;
        $estMinutes = $menu->prep_time ?? 20;

        return view('titiper.menu.show', [
            'menu'       => $menu,
            'rating'     => $rating,
            'estMinutes' => $estMinutes
        ]);
    }

    /**
     * CREATE ORDER FROM MENU DETAIL
     */
    public function createOrderFromMenu(Request $request, $menuId)
    {
        // validasi input, batasi qty atas agar konsisten dengan UI
        $data = $request->validate([
            'qty'  => 'required|integer|min:1|max:99',
            'note' => 'nullable|string|max:300',
        ]);

        // pastikan menu ada
        $menu = Menu::findOrFail($menuId);

        DB::beginTransaction();
        try {
            // pastikan model Order memiliki $fillable yang sesuai
            $order = Order::create([
                'user_id'     => auth()->id(),
                'menu_id'     => $menu->id,
                'qty'         => $data['qty'],
                'note'        => $data['note'] ?? null,
                'status'      => 'pending',
                'total_price' => ($menu->price ?? 0) * $data['qty'],
            ]);

            DB::commit();

            return redirect()
                ->route('titiper.orders.show', $order->id)
                ->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('createOrderFromMenu error: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'menu_id' => $menu->id ?? null,
                'payload' => $data
            ]);

            return back()->withInput()->withErrors('Terjadi masalah saat membuat pesanan. Silakan coba lagi.');
        }
    }
}
