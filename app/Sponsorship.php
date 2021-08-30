<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    protected $fillable = [
        'name', 
        'price', 
        'description'
    ]; 

    public function musicians() {
        return $this->belongsToMany('App\Musician'); 
    }
}
