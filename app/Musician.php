<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Musician extends Model
{
    protected $fillable = [
        'user_id', 
        'stagename',
        'slug', 
        'description',
        'bio',
        'typology',
        'cover'
    ]; 

    public function user() {
        return $this->hasOne('App\User'); 
    }

    public function genres() {
        return $this->belongsToMany('App\Genre'); 
    }

    public function sponsorships() {
        return $this->belongsToMany('App\Sponsorship'); 
    }

    public function messages() {
        return $this->belongsToMany('App\Message'); 
    }

    public function reviews() {
        return $this->belongsToMany('App\Review'); 
    }
}
