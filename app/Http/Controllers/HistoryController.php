<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class HistoryController extends Controller
{
    //
    public function historyIndex()
    {
        $myId = Auth::user()->id;

        // Pastikan pakai 'with' agar relasi item dan menu terbawa
        $orders = Order::with(['orderItems.menu', 'pickupLocation', 'deliveryLocation'])
                    ->whereNull('runner_id')
                    ->orWhere('runner_id', $myId)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('runner.history',compact('orders'));
    }

    public function accept($id)
    {
        $order = Order::findOrFail($id);

        if ($order->runner_id !== null) {
            return redirect()->back()->with('error', 'Yah, terlambat! Pesanan ini sudah diambil runner lain.');
        }

        // UPDATE DATABASE
        $order->update([
            'runner_id' => Auth::user()->id,
            'status' => 'accepted'
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil diambil! Status sekarang Pending.');
    }

 
    public function historyShow($id)
    {
        $order = Order::findOrFail($id);
        
        return view('runner.historydetail', compact('order'));
    }
}
