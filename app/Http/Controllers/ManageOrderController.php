<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ManageOrderController extends Controller
{
    /**
     * Menampilkan semua order (ADMIN)
     */
    public function index()
    {
        $orders = Order::with([
            'titiper',
            'runner'
        ])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('admin.orders.manageOrders', compact('orders'));
    }

    /**
     * ADMIN tidak membuat order
     */
    public function create()
    {
        abort(404);
    }

    /**
     * ADMIN tidak menyimpan order
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Detail order
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
     * Form update STATUS order (ADMIN)
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.orders.editOrder', compact('order'));
    }

    /**
     * Update STATUS order (ADMIN)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'status' => $request->status
        ]);

        // set timestamp sesuai status
        if ($request->status === 'accepted') {
            $order->accepted_at = now();
        }

        if ($request->status === 'completed') {
            $order->completed_at = now();
        }

        $order->save();

        return redirect()
            ->route('orders.index')
            ->with('success', 'Status order berhasil diperbarui');
    }

    /**
     * CANCEL order (soft delete)
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
            ->with('success', 'Order berhasil dibatalkan');
    }
}
