<?php

namespace App\Http\Controllers\Api;

use App\Musician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MusicianController extends Controller
{
    public function show($slug) {
        $musician = Musician::where('slug', $slug)->with('genres')->first();

        return response()->json($musician);
    }
}
