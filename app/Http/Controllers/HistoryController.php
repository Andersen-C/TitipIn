<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class HistoryController extends Controller
{
    public function historyIndex()
    {
        $myId = Auth::id();

        $orders = Order::with(['orderItems.menu', 'pickupLocation', 'deliveryLocation'])
                    ->where('runner_id', $myId)
                    
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('runner.history', compact('orders'));
    }

    public function historyShow($id)
    {
        $myId = Auth::id();

        $order = Order::with(['orderItems.menu', 'pickupLocation', 'deliveryLocation', 'titiper'])
                    ->where('runner_id', $myId) // Security check
                    ->findOrFail($id);
        
        return view('runner.historydetail', compact('order'));
    }
}