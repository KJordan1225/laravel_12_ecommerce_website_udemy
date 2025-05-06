<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $reviews = Review::latest()->get();
        return view('admin.reviews.index',compact('reviews'));
    }

    /**
     * Update the review status 
     */
    public function updateReviewStatus(Review $review, $status) : RedirectResponse
    {
        $review->update([
            'approved' => $status
        ]);
        if($status) {
            return to_route('admin.reviews.index')->with('success','Review approved successfully');
        }else {
            return to_route('admin.reviews.index')->with('success','Review disapproved successfully');
        }
    }

    /**
     * Delete reviews
     */
    public function destroy(Review $review) : RedirectResponse
    {
        $review->delete();
        return to_route('admin.reviews.index')->with('success','Review deleted successfully');
    }
}
