<?php

namespace App\Http\Controllers\Admin;

use App\Musician;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\User;
use Illuminate\Support\Facades\View;  

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Musician  $musician
     * @return \Illuminate\Http\Response
     */
    public function show(Musician $musician)

    {
        //dd($musician); 
        //return view('admin.musicians.show', compact('musician')); 
        return View::make('admin.musicians.show')->with(compact('musician')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Musician  $musician
     * @return \Illuminate\Http\Response
     */
    public function edit(Musician $musician)
    {
        //
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
        //
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
