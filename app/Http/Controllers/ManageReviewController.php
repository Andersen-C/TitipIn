<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ManageReviewController extends Controller
{
    /**
     * Menampilkan semua review (Admin)
     */
    public function index()
    {
        $reviews = Review::with([
            'order',
            'reviewer',      // titiper
            'reviewedUser'   // runner
        ])
        ->latest()
        ->paginate(10);

        return view('admin.reviews.manageReviews', compact('reviews'));
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        abort(404);
    }

    public function show($id)
    {
        $review = Review::with([
            'order',
            'reviewer',
            'reviewedUser'
        ])->findOrFail($id);

        return view('admin.reviews.showReview', compact('review'));
    }

    public function edit($id)
    {
        abort(404);
    }

    public function update(Request $request, $id)
    {
        abort(404);
    }

    public function destroy($id)
    {
        Review::findOrFail($id)->delete();

        return redirect()
            ->route('reviews.index')
            ->with('success', __('admin.DeleteReviewSuccessTitle'));
    }
}
