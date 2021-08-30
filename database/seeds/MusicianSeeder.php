<?php

use App\Musician;
use Illuminate\Database\Seeder; 
use Illuminate\Support\Str; 

class MusicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 3; $i++) {
            $newMusician = new Musician(); 

            $newMusician->user_id = 1; 
            $newMusician->stagename = "Nome d'arte".$i; 
            $newMusician->slug = Str::slug($newMusician->stagename, '-');
            $newMusician->bio = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sit amet luctus nisi. Nulla porta egestas dui id hendrerit. Duis faucibus arcu et ligula tempor, vel viverra mi feugiat. Integer pharetra nisi nec enim imperdiet blandit. Morbi justo dui, maximus in justo et, fermentum venenatis nibh. Praesent elementum ex vitae sem finibus gravida id et mi. Vestibulum eu purus a eros rutrum semper. Quisque sit amet dui non dui cursus aliquam id et ante. Sed porta enim massa, quis rhoncus arcu mattis at. Etiam facilisis est id vulputate convallis. Aliquam eget bibendum tortor."; 
            $newMusician->services = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam sit amet luctus nisi. Nulla porta egestas dui id hendrerit. Duis faucibus arcu et ligula tempor, vel viverra mi feugiat. Integer pharetra nisi nec enim imperdiet blandit. Morbi justo dui, maximus in justo et, fermentum venenatis nibh."; 
            $newMusician->cover = "https://www.dandi.media/wp-content/uploads/2017/02/20130118_speed_control_gbp_0051.jpg"; 
            $newMusician->typology = "Duo, Band, Solista"; 

            $newMusician->save(); 

        }
    }
}
