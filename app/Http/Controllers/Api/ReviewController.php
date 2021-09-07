<?php

namespace App\Http\Controllers\Api;

use App\Review;

use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $review = $request->all();

        $validator = Validator::make($review, [
            'name' => 'required',
            'email' => 'required',
            'review' => 'required',
            'vote' => 'required',
            // 'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {

            $newReview = new Review();

            $newReview['musician_id'] = $review['musician_id'];

            $newReview->fill($review);

            $newReview->save();

            return response()->json($newReview);
        }
    }
}
