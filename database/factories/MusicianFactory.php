<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Musician;
use Faker\Generator as Faker;

$factory->define(Musician::class, function (Faker $faker) {
    return [
        "id" => 3,
        "user_id" => 2,
        "stagename" => "Er Teribile",
        "slug" => "er-teribile",
        "bio" => "Uno che spacca i palchi",
        "services" => "Matrimoni, feste private",
        "cover" => "https://www.dandi.media/wp-content/uploads/2017/02/20130118_speed_control_gbp_0051.jpg",
        "typology" => "Solista"
    ];
});
