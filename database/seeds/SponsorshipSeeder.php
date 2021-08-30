<?php

use App\Sponsorship;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorships = [
            [
                'name' => 'Oro', 
                'price' => 2.99, 
                'description' => 'Descrizione promo Oro'
            ], 
            [
                'name' => 'Platino', 
                'price' => 5.99, 
                'description' => 'Descrizione promo Platino'
            ],
            [
                'name' => 'Diamante', 
                'price' => 9.99, 
                'description' => 'Descrizione promo Diamante'
            ],
        ]; 

        foreach($sponsorships as $sponsorship) {
            $newSponsorship = new Sponsorship(); 

            $newSponsorship->name = $sponsorship['name']; 
            $newSponsorship->price = $sponsorship['price'];
            $newSponsorship->description =  $sponsorship['description'];

            $newSponsorship->save(); 
        }
    }
}
