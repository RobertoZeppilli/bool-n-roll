<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'name', 
        'surname', 
        'email', 
        'review', 
        'vote', 
        'musician_id'
    ]; 

    public function musician() {
        return $this->belongsTo('App\Musician'); 
    }
}
