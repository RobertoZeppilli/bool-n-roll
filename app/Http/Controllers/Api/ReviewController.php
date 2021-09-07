<?php

namespace App\Http\Controllers\Api;

use App\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request) {
        $review = $request->all();

        $newReview = new Review();

        $newReview['musician_id'] = $review['musician_id'];

        $newReview->fill($review);

        $newReview->save();

        return response()->json($newReview);
    }
}
