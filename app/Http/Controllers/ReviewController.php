<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AddReviewRequest;

class ReviewController extends Controller
{
    /**
     * Store a review
     */
    public function store(AddReviewRequest $request) : RedirectResponse
    {
        //check if the review exists
        $review = Review::where([
            'product_id' => $request->product_id,
            'user_id' => auth()->user()->id
        ])->first();
        //get the form data 
        $data = $request->validated();
        $data['product_id'] =  $request->product_id;
        $data['user_id'] =  auth()->user()->id;
        //if the review already exists
        if($review) {
            $data['approved'] = 0;
            $review->update($data);
            return back()->with('success','Review updated and will be published soon');
        }else {
            Review::create($data);
            return back()->with('success','Review added and will be published soon');
        }
    }
}
