<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //

    public function runnerOrder($id)
    {
        $order = Order::findOrFail($id);
        return view('runner.order', compact('order'));
    }

    public function runnerIndex()
    {
        //
        // $order = Order::findOrFail($id);
        return view('runner.order');
    }

    public function runnerShow()
    {
        //
        return view('runner.order.');
    }


}
