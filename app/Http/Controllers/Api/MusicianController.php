<?php

namespace App\Http\Controllers\Api;

use App\Musician;
use App\Sponsorship;

use Illuminate\Support\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MusicianController extends Controller
{
    public function show($slug) {
        $musician = Musician::where('slug', $slug)->with('genres')->first();

        return response()->json($musician);
    }

    public function showSponsoredMusicians() {

        // $sponsorships = Sponsorship::with('musicians')->get();

        // return response()->json($sponsorships);
        $musicians = Musician::all();
        $sponsoredMusicians = Musician::has('sponsorships')->get();
        $currentDate = Carbon::now('Europe/Rome');

        $activeSponsorship = [];

        foreach($sponsoredMusicians as $musician) {
            foreach($musician->sponsorships as $sponsorship) {
                if($currentDate <= $sponsorship->pivot->end_date) {
                    if(!in_array($musician, $activeSponsorship)) {
                        array_push($activeSponsorship, $musician);
                    }
                }
            }
        }

        
        return response()->json([
            'musicians' => $musicians,
            'sponsorship' => $activeSponsorship
        ]);

    }

    // public function home()
    // {
    //     date_default_timezone_set('Europe/Rome');
    //     $users = User::all();
    //     $sponsoredUsers = User::has('sponsorships')->get();
    //     $currentDate = date("Y-m-d H:i:s");
    //     $activeSponsorship = [];

    //     foreach ($sponsoredUsers as $user) {
    //         foreach ($user->sponsorships as $sponsorship) {
    //             if ($sponsorship->pivot->expiration_time > $currentDate) {
    //                 if (!in_array($user, $activeSponsorship)) {
    //                     array_push($activeSponsorship, $user);
    //                 }
    //             }
    //         }
    //     };

    //     $specializations = Specialization::has('users')->get();
    //     return view('public.homepage', compact('users', 'specializations', 'activeSponsorship'));
    // }
}
