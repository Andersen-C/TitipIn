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


    // Runner
    public function runnerIndex()
    {
        $myId = Auth::id();

        $orders = Order::with(['orderItems.menu', 'pickupLocation', 'deliveryLocation'])
            ->where(function($query) use ($myId) {
                $query->whereNull('runner_id')
                      ->orWhere('runner_id', $myId);
            })
            ->whereNotIn('status', ['completed', 'cancelled']) 
            ->orderBy('created_at', 'desc')
            ->get();

        return view('runner.order', compact('orders'));
    }

    public function runnerShow($id)
    {
        $order = Order::with(['orderItems.menu', 'pickupLocation', 'deliveryLocation', 'titiper'])->findOrFail($id);
        $myId = Auth::id();

        if ($order->runner_id == null) {
            return view('runner.orderdetail', compact('order'));
        }
        if ($order->runner_id != $myId) {
            return redirect()->route('runner.orders.index')->with('error', 'Pesanan ini milik runner lain.');
        }

        switch ($order->status) {
            case 'accepted':
                return view('runner.orderaccept', compact('order'));
            
            case 'item_picked':
                return view('runner.orderpickup', compact('order'));            
            
            case 'on_delivery':
            case 'delivering': 
                 return view('runner.orderdeliver', compact('order'));
            
            case 'completed':
                return view('runner.ordercomplete', compact('order'));            
            
            default:
                return view('runner.orderaccept', compact('order'));
        }
    }

    public function accept($id)
    {
        $order = Order::findOrFail($id);

        if ($order->runner_id !== null) {
            return redirect()->back()->with('error', 'Yah, terlambat! Pesanan ini sudah diambil runner lain.');
        }
        $order->update([
            'runner_id' => Auth::id(),
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);

        return redirect()->route('runner.orders.show', $id)->with('success', 'Pesanan berhasil diambil!');
    }

    public function pickupOrder($id)
    {
        $order = Order::where('id', $id)->where('runner_id', Auth::id())->firstOrFail();        
        $order->update(['status' => 'item_picked']); 
        
        return redirect()->route('runner.orders.show', $id);
    }

     public function accepted($id)
    {   
        $order = Order::findOrFail($id);
        $order->update([
            'accepted_at' => now(),
            'runner_id' => Auth::user()->id,
            'status' => 'accepted'

        ]);
        return view('runner.orderaccept', compact('order') );
    }

    public function pickup($id)
    {
        $order = Order::findOrFail($id);
        return view('runner.orderpickup', compact('order') );
    }

    public function deliver($id)
    {
        $order = Order::findOrFail($id);
        return view('runner.orderdeliver', compact('order') );
    }

    public function complete($id)
    {
        $order = Order::findOrFail($id);
        return view('runner.ordercomplete', compact('order') );
    }
}