<?php

namespace App\Http\Controllers\Admin;

use App\Genre;
use App\Musician;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\User;
use Illuminate\Support\Facades\View;  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MusicianController extends Controller
{
    private $validationArray = [
        'name' => 'required|max:20', 
        'surname' => 'required|max:50', 
        'stagename' => 'required|max:50', 
        'bio' => 'required', 
        'services' => 'required', 
        'cover' => 'nullable|image', 
        'genres' => 'exists:genres,id'
    ]; 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Musician::where('user_id', Auth::id())->with('user')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $genres = Genre::all(); 
        $musician = Musician::where('user_id',Auth::id())->get(); 
        return view('admin.musicians.create', compact('genres','user','musician'));
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

        $newMusician = Musician::create([
            'stagename' => $request->stagename, 
            'user_id' => Auth::id(),
            'bio' => $request->bio,
            'services' => $request->services, 
            'typology' => $request->typology, 
            
        ]); 

        $data['user_id'] = Auth::id(); 
        
        if (array_key_exists('cover', $data)) {
            $data['cover'] = Storage::put('covers', $data['cover']);
        }

        $newMusician->fill($data);

        $newMusician->save();
        
        if (array_key_exists('genres', $data)) {
            $newMusician->genres()->attach($data['genres']);
        }
        

        return redirect()->route('admin.musicians.index', $newMusician->id); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Musician  $musician
     * @return \Illuminate\Http\Response
     */
    public function show(Musician $musician, User $user)

    {
    
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
        $user = Auth::user(); 
        $genres = Genre::all(); 
        return view('admin.musicians.edit', compact('musician','genres','user')); 
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

        //dd($data); 

        $request->validate($this->validationArray); 

        $musician->update($data); 

        if(array_key_exists('cover',$data)) {
            if($musician->cover) {
                Storage::delete($musician->cover);
            }
            $data['cover'] = Storage::put('covers', $data['cover']);
        }
        
        if(array_key_exists('genres',$data)) {
            $musician->genres()->sync($data['genres']); 
        } else {
            $musician->genres()->detach(); 
        }

        return redirect()->route('admin.musicians.show', $musician->id)->with('message','Il profilo è stato modificato correttamente'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Musician  $musician
     * @return \Illuminate\Http\Response
     */
    public function destroy(Musician $musician)
    {
        //
    }
}
