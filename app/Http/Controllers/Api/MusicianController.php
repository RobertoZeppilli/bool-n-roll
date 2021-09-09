<?php

namespace App\Http\Controllers\Api;

use App\Musician;
use App\Sponsorship;

use Illuminate\Support\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MusicianController extends Controller
{
    public function show($slug)
    {
        $musician = Musician::where('slug', $slug)->with('genres', 'reviews')->first();

        return response()->json($musician);
    }

    public function showSponsoredMusicians()
    {
        $sponsoredMusicians = Musician::has('sponsorships')->with('reviews')->get();
        $currentDate = Carbon::now('Europe/Rome');

        $activeSponsorship = [];

        foreach ($sponsoredMusicians as $musician) {
            foreach ($musician->sponsorships as $sponsorship) {
                if ($currentDate <= $sponsorship->pivot->end_date) {
                    if (!in_array($musician, $activeSponsorship)) {
                        array_push($activeSponsorship, $musician);
                    }
                }
            }
        }


        return response()->json([
            // 'musicians' => $musicians,
            'sponsorship' => $activeSponsorship,
            
        ]);
    }
}
