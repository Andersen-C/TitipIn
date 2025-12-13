<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function runnerIndex()
    {
        $myId = Auth::user()->id;
        $orders = Order::with(['orderItems.menu', 'pickupLocation', 'deliveryLocation'])
                    ->whereNull('runner_id')
                    ->orWhere('runner_id', $myId)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view('runner.order', compact('orders'));
    }

    public function accept($id)
    {
        $order = Order::findOrFail($id);
        if ($order->runner_id !== null) {
            return redirect()->back()->with('error', 'Yah, terlambat! Pesanan ini sudah diambil runner lain.');
        }
        $order->update([
            'runner_id' => Auth::user()->id,
            'status' => 'accepted'
        ]);
        return redirect()->back()->with('success', 'Pesanan berhasil diambil! Status sekarang Pending.');
    }


    public function runnerShow($id)
    {
        $order = Order::findOrFail($id);
        return view('runner.orderdetail', compact('order'));
    }

     public function accepted()
    {
        return view('runner.orderaccept' );
    }
}