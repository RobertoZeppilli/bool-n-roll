<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Genre;

class GenreController extends Controller
{
    public function index() {

        $genres = Genre::all();

        return response()->json($genres);
    }

    public function filter($id) {

        $genres = Genre::where('id', $id)->with('musicians')->get();

        return response()->json($genres);
    }
}
