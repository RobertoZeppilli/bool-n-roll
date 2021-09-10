<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Musician;
use App\Message;
use App\Review;

use Illuminate\Support\Facades\Auth;

class StatController extends Controller
{
    
    public function showStats(){


        // prendo i dati del dottore registrato
        

        $musician = Musician::where('user_id', Auth::id())->first();
        // accedo alle tabelle dei messaggi e recensioni per prenderne i dati
        $messages = Message::where('musician_id', $musician->id)->get();

        $reviews = Review::where('musician_id', $musician->id)->get();


        return view('admin.musicians.stats', compact('musician', 'messages', 'reviews'));
    }
}
