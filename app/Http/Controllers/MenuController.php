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
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
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
            $subCategories = collect(); 
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

    public function confirmation(Request $request, $menuId)
    {
        $data = $request->validate([
            'qty'  => 'required|integer|min:1|max:99',
            'note' => 'nullable|string|max:300',
        ]);

        $menu = Menu::with('location')->findOrFail($menuId);
        $locations = Location::where('name', 'LIKE', '%Kelas%')->orderBy('name')->get();

        $quantity   = (int) $data['qty'];
        $subtotal   = $menu->price * $quantity;
        $serviceFee = 3000.00;
        $totalPrice = $subtotal + $serviceFee;

        $imgUrl = 'https://via.placeholder.com/150';
        if (!empty($menu->image)) {
            if (\Illuminate\Support\Str::startsWith($menu->image, ['http://', 'https://'])) {
                $imgUrl = $menu->image;
            } elseif (\Illuminate\Support\Str::startsWith($menu->image, ['/storage/', 'storage/'])) {
                $imgUrl = asset(ltrim($menu->image, '/'));
            } else {
                $imgUrl = asset('storage/' . ltrim($menu->image, '/'));
            }
        }

        return view('titiper.menu.paymentSummary', [
            'menu'       => $menu,
            'qty'        => $quantity,
            'note'       => $data['note'] ?? '',
            'locations'  => $locations,
            'subtotal'   => $subtotal,
            'serviceFee' => $serviceFee,
            'totalPrice' => $totalPrice,
            'imgUrl'     => $imgUrl
        ]);
    }

    public function storeOrder(Request $request, $menuId)
    {
        $data = $request->validate([
            'qty'                  => 'required|integer|min:1',
            'note'                 => 'nullable|string',
            'pickup_location_id'   => 'required|exists:locations,id',
            'delivery_location_id' => 'required|exists:locations,id',
        ]);

        $menu = Menu::findOrFail($menuId);
        $user = Auth::user();

        $quantity   = (int) $data['qty'];
        $price      = (float) $menu->price;
        $subtotal   = $price * $quantity;
        $serviceFee = 3000.00;
        $totalPrice = $subtotal + $serviceFee;

        DB::beginTransaction();
        try {
            $order = Order::create([
                'titiper_id'           => $user->id,
                'pickup_location_id'   => $data['pickup_location_id'], 
                'delivery_location_id' => $data['delivery_location_id'], 
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

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function storeLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:50',
            'floor_number' => 'required|integer|min:0|max:100',
        ], [
            'name.required' => 'Nama lokasi wajib diisi.',
            'floor_number.required' => 'Lantai wajib diisi.',
            'floor_number.integer' => 'Lantai harus berupa angka.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'validation_error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $location = Location::create([
                'name'         => $request->name,
                'floor_number' => $request->floor_number,
            ]);

            return response()->json([
                'status'   => 'success',
                'message'  => 'Lokasi berhasil ditambahkan!',
                'location' => $location,
                'formatted_floor' => $location->floor_number == 0 ? 'Basement' : 'Lantai ' . $location->floor_number
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ], 500);
        }
    }
}
