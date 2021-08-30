<?php

use App\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviews = [
            "Ottima band sono molto contenta", 
            "Fanno schifo davvero tantissimo", 
            "Bravi ma neanche troppo"
        ]; 

        foreach($reviews as $review) {
            $newReview = new Review(); 

            $newReview->musician_id = 2; 
            $newReview->name = "Michela";
            $newReview->surname = "Franchini"; 
            $newReview->email = "michela@email.com"; 
            $newReview->review = $review; 
            $newReview->vote = 5; 

            $newReview->save(); 
        }
    }
}
