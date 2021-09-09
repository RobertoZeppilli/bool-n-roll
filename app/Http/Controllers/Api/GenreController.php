<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Genre;

use App\Musician;

class GenreController extends Controller
{
    public function index() {

        $genres = Genre::all();

        return response()->json($genres);
    }

    public function filterMusicians($slug) {

        // $musicians
        $genres = Genre::where('slug', $slug)->with('musicians')->get();

        // $musicians = Musician::has('reviews')->with('reviews')->get();
        

        return response()->json($genres);
    }
}
