<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function landing()
    {
        return view('beforeLogin.landing');
    }

    public function feature()
    {
        return view('beforeLogin.Feature');
    }

    public function howItWorks()
    {
        return view('beforeLogin.HowItWorks');
    }

    public function adminHome()
    {
        $users = User::count();
        $activeRunner = User::where('mode', 'runner')->count();
        $menus = Menu::count();
        $orders = Order::count();
        $topThreeRunner = Order::select('runner_id')
            ->selectRaw('COUNT(*) as total_orders')
            ->whereNotNull('runner_id')
            ->groupBy('runner_id')
            ->orderByDesc('total_orders')
            ->take(3)
            ->with('runner')
            ->get();
        $topThreeMenu = OrderItem::select('menu_id', DB::raw('COUNT(*) as total_sold'))
            ->with(['menu', 'order'])
            ->groupBy('menu_id')
            ->orderByDesc('total_sold')
            ->take(3)
            ->get();

        $dates = [];
        $orderTotals = [];
        $chartLabels = [];
        $orderAmountTotal = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dates[] = $date;

            $chartLabels[] = now()->subDays($i)->format('m-d');

            $total = Order::whereDate('created_at', $date)->sum('total_price');
            $orderTotals[] = $total > 0 ? $total : 0;

            $orderAmount = Order::whereDate('created_at', $date)->count();
            $orderAmountTotal[] = $orderAmount > 0 ? $orderAmount : 0;
        }

        return view('admin.adminHome', compact('users', 'activeRunner', 'menus', 'orders', 'dates', 'chartLabels', 'orderTotals', 'orderAmountTotal', 'topThreeRunner', 'topThreeMenu'));
    }

    public function manage()
    {
        return view('admin.manage');
    }

    public function titiperHome()
    {
        $latestOrders = Order::with(['orderItems.menu', 'titiper']) 
            ->where('titiper_id', auth()->id())
            ->latest()
            ->take(4)
            ->get();

        $recommended = \App\Models\Menu::inRandomOrder()->take(5)->get();

        return view('titiper.home', compact(
            'latestOrders',
            'recommended'
        ));
    }


    public function runnerHome()
    {
        $user = auth()->user();

        $totalEarnings = Order::where('runner_id', $user->id)
            ->where('status', 'completed')
            ->sum('service_fee');

        $rating = $user->avg_rating ?? 0;

        return view('runner.home', compact('totalEarnings', 'rating', 'user'));
    }
}
