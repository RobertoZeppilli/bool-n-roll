<?php

use App\Message;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = [
            "Ottima band sono molto contenta", 
            "Fanno schifo davvero tantissimo", 
            "Bravi ma neanche troppo"
        ]; 

        foreach($messages as $message) {
            $newMessage = new Message(); 

            $newMessage->musician_id = 2; 
            $newMessage->name = "Michela";
            $newMessage->surname = "Franchini"; 
            $newMessage->email = "michela@email.com"; 
            $newMessage->message = $message; 

            $newMessage->save(); 
        }
    }
}
