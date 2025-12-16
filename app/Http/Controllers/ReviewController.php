<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $orderId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $order = Order::findOrFail($orderId);

        if ($order->titiper_id !== Auth::id()) {
            return back()->with('error', __('titiper.NoAccess'));
        }

        if ($order->status !== 'completed') {
            return back()->with('error', __('titiper.OrderUncomplete'));
        }

        $existingReview = Review::where('order_id', $order->id)->first();
        if ($existingReview) {
            return back()->with('error', __('titiper.OrderReviewed'));
        }

        Review::create([
            'order_id'   => $order->id,
            'titiper_id' => Auth::id(),
            'runner_id'  => $order->runner_id,
            'rating'     => $request->rating,
            'comment'    => $request->review,
        ]);

        if ($order->runner) {
            $order->runner->update_rating();
        }

        return back()->with('success', __('titiper.SubmitReview'));
    }
}
