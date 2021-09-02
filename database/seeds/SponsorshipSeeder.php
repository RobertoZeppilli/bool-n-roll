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
                'description' => 'Per 24 ore il tuo profilo sarà messo in cima nelle ricerche.',
                'duration' => 24
            ], 
            [
                'name' => 'Platino', 
                'price' => 5.99, 
                'description' => 'Per 72 ore il tuo profilo sarà messo in cima nelle ricerche.',
                'duration' => 72
            ],
            [
                'name' => 'Diamante', 
                'price' => 9.99, 
                'description' => 'Per 144 ore il tuo profilo sarà messo in cima nelle ricerche.',
                'duration' => 144
            ],
        ]; 

        foreach($sponsorships as $sponsorship) {
            $newSponsorship = new Sponsorship(); 

            $newSponsorship->name = $sponsorship['name']; 
            $newSponsorship->price = $sponsorship['price'];
            $newSponsorship->description =  $sponsorship['description'];
            $newSponsorship->duration = $sponsorship['duration'];

            $newSponsorship->save(); 
        }
    }
}
