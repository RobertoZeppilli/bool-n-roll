<?php

namespace App\Http\Controllers\Admin;

use App\Musician;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\User;
use Illuminate\Support\Facades\View;  
use Illuminate\Support\Facades\Auth;

use App\Genre;
use App\Sponsorship;

use Braintree;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MusicianController extends Controller
{
    private $validationArray = [
        // 'name' => 'required|max:20', 
        // 'surname' => 'required|max:50', 
        'stagename' => 'required|max:50', 
        'bio' => 'required', 
        'services' => 'required', 
        'cover' => 'nullable|image', 
        'typology' => 'required',
        'genres' => 'required|exists:genres,id'
    ]; 

    private function createSlug($data)
    {
        $slug = Str::slug($data["stagename"], "-");
        $musicianExist = Musician::where('slug', $slug)->first();

        $starterSlug = $slug;
        $counter = 1;

        while ($musicianExist) {
            $slug = $starterSlug . '-' . $counter;

            $musicianExist = Musician::where('slug', $slug)->first();
            $counter++;
        }

        return $slug;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Musician::where('user_id', Auth::id())->first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Musician $musician)
    {   
        $genres = Genre::all();
        $user = Auth::user();

        return view('admin.musicians.create', compact('genres', 'user' ,'musician'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate($this->validationArray);
        
        $musician = new Musician();

        $slug = $this->createSlug($data);
        $data['slug'] = $slug;

        if (array_key_exists('cover', $data)) {
            $data['cover'] = Storage::put('covers', $data['cover']);
        }

        
        $musician->fill($data);

        $musician->user_id = Auth::id();

        $musician->save();

        if (array_key_exists('genres', $data)) {
            $musician->genres()->attach($data['genres']);
        }

        return redirect()
            ->route('admin.musicians.show', $musician->id)
            ->with('message', 'Profilo Creato!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Musician  $musician
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)

    {
        $musician = Musician::where('user_id', Auth::id())->first();

        return view('admin.musicians.show', compact('user', 'musician'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Musician  $musician
     * @return \Illuminate\Http\Response
     */
    public function edit(Musician $musician)
    {   
        $genres = Genre::all();

        return view('admin.musicians.edit', compact('musician', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Musician  $musician
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Musician $musician)
    {
        $data = $request->all();

        $request->validate($this->validationArray);

        if ($musician->stagename != $data['stagename']) {
            $slug = $this->createSlug($data);
            $data['slug'] = $slug;
        }

        if (array_key_exists('cover', $data)) {
            if ($musician->cover) {
                Storage::delete($musician->cover);
            }

            $data['cover'] = Storage::put('covers', $data['cover']);
        }

        $musician->update($data);

        if (array_key_exists('genres', $data)) {
            $musician->genres()->sync($data['genres']);
        } else {
            $musician->genres()->detach();
        }

        return redirect()
            ->route('admin.musicians.show', $musician->id)
            ->with('message', 'Profilo modificato!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Musician  $musician
     * @return \Illuminate\Http\Response
     */
    public function destroy(Musician $musician)
    {   
        if($musician->cover) {
            Storage::delete($musician->cover);
        }

        $musician->delete();

        return redirect()->route('admin.welcome')->with('message', 'Profilo eliminato');
    }

    public function showSponsorPage() {
        
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
    
        $token = $gateway->ClientToken()->generate();

        $user = Auth::user();
        $sponsorships = Sponsorship::all();
        return view('admin.musicians.sponsor', compact('user', 'token', 'sponsorships'));
    }

    public function showMessagePage() {
        $user = Auth::user();
        return view('admin.musicians.messages', compact('user'));
    }
    
    public function showReviewPage() {
        $user = Auth::user();
        return view('admin.musicians.reviews', compact('user'));
    }

    



   
}