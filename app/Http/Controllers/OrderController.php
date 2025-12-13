<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Jangan lupa import Auth

class OrderController extends Controller
{
    /**
     * 1. Menampilkan Daftar Orderan untuk Runner (Halaman Utama Runner)
     * Route: GET /runner/orders
     */
    public function runnerIndex()
    {
        $myId = auth()->id();

        // Pastikan pakai 'with' agar relasi item dan menu terbawa
        $orders = Order::with(['orderItems.menu', 'pickupLocation', 'deliveryLocation'])
                    ->whereNull('runner_id')
                    ->orWhere('runner_id', $myId)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('runner.order', compact('orders'));
    }


     // 2. Logic Menerima Orderan (Saat tombol 'Terima' ditekan)

    public function accept($id)
    {
        $order = Order::findOrFail($id);

        if ($order->runner_id !== null) {
            return redirect()->back()->with('error', 'Yah, terlambat! Pesanan ini sudah diambil runner lain.');
        }

        // UPDATE DATABASE
        $order->update([
            'runner_id' => auth()->id(),
            'status' => 'accepted' // SESUAIKAN dengan enum di database kamu ('accepted')
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil diambil! Status sekarang Pending.');
    }

    /**
     * 3. Menampilkan Detail Satu Orderan (Saat tombol 'Detail' ditekan)
     * Route: GET /runner/orders/{id}
     */
    public function runnerShow($id)
    {
        $order = Order::findOrFail($id);
        
        return view('runner.orderdetail', compact('order'));
    }
}