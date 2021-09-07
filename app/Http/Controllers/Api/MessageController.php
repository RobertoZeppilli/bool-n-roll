<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $message = $request->all();

        $validator = Validator::make($message, [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'message' => 'required',
            // 'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        } else {
            $newMessage = new Message();

            $newMessage['musician_id'] = $message['musician_id'];

            $newMessage->fill($message);

            $newMessage->save();

            return response()->json($newMessage);
        }
    }
}
