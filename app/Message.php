<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name', 
        'surname', 
        'email', 
        'message', 
        'musician_id'
    ]; 

   

    public function musician() {
        return $this->belongsTo('App\Musician'); 
    }
}
