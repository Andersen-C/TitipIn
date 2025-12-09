<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function landing() {
        return view('beforeLogin.landing');
    }

    public function adminHome() {
        return view('admin.adminHome');
    }
        
    public function titiperHome()
{
    // Ambil pesanan terbaru user yg login (titiper/pembeli)
    $latestOrders = \App\Models\Order::with(['menu', 'user'])
        ->where('titiper_id', auth()->id())
        ->latest()
        ->take(4)
        ->get();

    // Menu terlaris / fallback ke menu terbaru
    

    // Rekomendasi menu (6 item)
    $recommended = \App\Models\Menu::latest()->take(6)->get();

    return view('titiper.titiperHome', compact(
        'latestOrders',
        'recommended'
    ));
}


    public function runnerHome() {
        return view('runner.runnerHome');
    }

    
}
