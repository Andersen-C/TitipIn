<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Location;
use Illuminate\Support\Facades\Auth;
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

        if (class_exists(Category::class)) {
            $allCategories = Category::orderBy('name')->get();
            $groups = $allCategories->pluck('group')->unique()->filter()->values();
        } else {
            $names = Menu::select('category')->distinct()->pluck('category')->filter()->values();
            $allCategories = $names->map(fn($n) => (object)[
                'id' => $n,
                'name' => $n,
                'group' => null
            ]);
            $groups = collect();
        }

        if ($group && $groups->isNotEmpty()) {
            $subCategories = $allCategories->filter(
                fn($c) => $c->group == $group
            )->values();
        } else {
            $subCategories = collect(); // kosong
        }

        $menusQuery = Menu::query()->with('category');

        if ($q) {
            $menusQuery->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

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
        $menu = Menu::with('category')->findOrFail($menuId);

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
        $data = $request->validate([
            'qty'  => 'required|integer|min:1|max:99',
            'note' => 'nullable|string|max:300',
        ]);

        $menu = Menu::findOrFail($menuId);
        $user = Auth::user();

        $quantity   = (int) $data['qty'];
        $price      = (float) $menu->price;
        $subtotal   = $price * $quantity;
        $serviceFee = 3000.00;
        $totalPrice = $subtotal + $serviceFee;

        $pickupLocId   = $menu->location_id ?? Location::first()->id ?? 1;
        $deliveryLocId = $user->location_id ?? Location::first()->id ?? 1;

        DB::beginTransaction();
        try {
            $order = Order::create([
                'titiper_id'           => $user->id,
                'pickup_location_id'   => $pickupLocId,
                'delivery_location_id' => $deliveryLocId,
                'status'               => 'waiting_runner',
                'subtotal'             => $subtotal,
                'service_fee'          => $serviceFee,
                'total_price'          => $totalPrice,
                'notes'                => $data['note'] ?? null,
                'payment_method'       => 'cash',
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'menu_id'  => $menu->id,
                'quantity' => $quantity,
                'price'    => $price,
            ]);

            DB::commit();

            return redirect()
                ->route('titiper.orders.index')
                ->with('success', 'Pesanan berhasil dibuat! Menunggu Runner.');
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Order Failed: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors('Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
