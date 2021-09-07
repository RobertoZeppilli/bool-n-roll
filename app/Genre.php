<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'name', 
        'slug'
    ]; 

    public function musicians() {
        return $this->belongsToMany('App\Musician');
    }
}
