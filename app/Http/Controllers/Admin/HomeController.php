<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Musician;
use App\User;
use Illuminate\Support\Facades\Auth;

use Braintree;

class HomeController extends Controller
{
    public function index() {

        $user = Auth::user();
        $musician = Musician::where('user_id', Auth::id())->with('messages', 'reviews')->first();

        return view('admin.welcome', compact('musician', 'user')); 
    }


   
    
}