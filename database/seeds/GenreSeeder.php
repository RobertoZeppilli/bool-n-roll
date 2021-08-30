<?php

use App\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; 

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            'Rock', 'Metal', 'Pop', 'Jazz', 'Folk', 'Blues', 'RnB', 'Punk', 'Bossanova', 'Grunge', 'Country', 'Elettronica', 'Techno', 'Ska', 'Classica', 'Sperimentale', 'Altro'
        ]; 

        foreach($genres as $genre) {
            $newGenre = new Genre(); 
            
            $newGenre->name = $genre; 
            $newGenre->slug = Str::slug($genre, '-'); 

            $newGenre->save(); 
        }
    }
}
