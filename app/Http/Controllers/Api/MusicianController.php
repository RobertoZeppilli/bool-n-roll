<?php

namespace App\Http\Controllers\Api;

use App\Musician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MusicianController extends Controller
{
    public function show($id) {
        $musician = Musician::where('id', $id)->first();

        return response()->json($musician);
    }
}
