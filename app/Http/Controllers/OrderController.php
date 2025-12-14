<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $currentStatus = $request->query('status', 'Semua');
        $userId = Auth::id();

        $query = Order::where('titiper_id', $userId)
            ->with(['orderItems.menu', 'pickupLocation', 'deliveryLocation', 'runner'])
            ->latest();

        if ($currentStatus === 'Menunggu') {
            $query->where('status', 'waiting_runner');
        } elseif ($currentStatus === 'Sedang Dibelikan') {
            $query->whereIn('status', ['accepted', 'arrived_at_pickup', 'item_picked', 'on_delivery', 'delivered']);
        } elseif ($currentStatus === 'Selesai') {
            $query->where('status', 'completed');
        } elseif ($currentStatus === 'Dibatalkan') {
            $query->where('status', 'cancelled');
        }

        $orders = $query->get();

        return view('titiper.orders.index', compact('orders', 'currentStatus'));
    }


    public function destroy(Request $request, $id)
    {
        $order = Order::where('titiper_id', Auth::id())->findOrFail($id);

        if ($order->status === 'waiting_runner') {
            $order->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
        }

        return redirect()->back()->with('error', 'Pesanan sudah diproses, tidak bisa dibatalkan.');
    }


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