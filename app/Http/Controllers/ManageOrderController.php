<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ManageOrderController extends Controller
{
    /**
     * READ: Menampilkan semua order (ADMIN)
     */
    public function index()
    {
        $orders = Order::with(['titiper', 'runner'])
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->onEachSide(1); // <<< INI PENTING

        return view('admin.orders.manageOrders', compact('orders'));
    }

    /**
     * CREATE: Admin TIDAK membuat order
     */
    public function create()
    {
        abort(404);
    }

    /**
     * STORE: Admin TIDAK menyimpan order
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * READ (Detail): Detail order
     */
    public function show($id)
    {
        $order = Order::with([
            'titiper',
            'runner',
            'pickupLocation',
            'deliveryLocation',
            'orderItems.menu'
        ])->findOrFail($id);

        return view('admin.orders.showOrder', compact('order'));
    }

    /**
     * UPDATE (Form): Form update STATUS order
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.orders.editOrder', compact('order'));
    }

    /**
     * UPDATE (Action): Update STATUS order
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:waiting_runner,accepted,arrived_at_pickup,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);

        // update status utama
        $order->status = $request->status;

        // set timestamp sesuai status
        if ($request->status === 'accepted') {
            $order->accepted_at = now();
        }

        if ($request->status === 'completed') {
            $order->completed_at = now();
        }

        if ($request->status === 'cancelled') {
            $order->cancelled_at = now();
        }

        $order->save();

        return redirect()
            ->route('orders.index')
            ->with('success', __('admin.UpdateOrderSuccessTitle'));
    }

    /**
     * DELETE: Cancel order (soft delete via status)
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => 'cancelled',
            'cancelled_at' => now()
        ]);

        return redirect()
            ->route('orders.index')
            ->with('success', __('admin.DeleteOrderSuccessTitle'));
    }
}
