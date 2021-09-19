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
        'services',
        'typology',
        'cover'
    ]; 

    protected $with = [
        'reviews',
        'messages'
    ];


    public function user() {
        return $this->hasOne('App\User'); 
    }

    public function genres() {
        return $this->belongsToMany('App\Genre'); 
    }

    public function sponsorships() {
        return $this->belongsToMany('App\Sponsorship')->withPivot('end_date'); 
    }

    public function messages() {
        return $this->hasMany('App\Message'); 
    }

    public function reviews() {
        return $this->hasMany('App\Review');
    }
}
