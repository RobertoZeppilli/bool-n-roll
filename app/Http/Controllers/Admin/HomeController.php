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
        $musician = Musician::where('user_id', Auth::id())->first();

        $newMessage = [];

        if($user->musician && count($musician->messages) > 0) {
            foreach($musician->messages as $message) {
                if($message->readed === 0) {
                    array_push($newMessage, $musician->messages);
                }
            }
        }
        // $messages = [];

        // for($i = 0; $i < count($musician); $i++) {
        //     array_push($messages ,$musician->messages);
        // }

        return view('admin.welcome', compact('musician', 'user', 'newMessage')); 
    }


   
    
}