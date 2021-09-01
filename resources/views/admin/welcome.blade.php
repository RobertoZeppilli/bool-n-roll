@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
        <div class="alert alert-success">
            <h6>{{ session('message') }}</h6>
        </div>
    @endif
    <h1>Dashboard musicista</h1>

    <div class="profile">
        <h2>Vedi il tuo profilo</h2>
        
        {{-- la rotta prende l'id del musicista legato all'utente autenticato --}}
        <a class="btn btn-warning" href="{{ route('admin.musicians.show', $user->id) }}">Vedi il profilo</a>
        <a class="btn btn-secondary" href="{{ route('admin.musicians.create', $user->id) }}">Crea</a>
        
        {{ $user->name }}
        {{$user->id}}

        {{-- questo è per capire se prendevo dati dalla relazione 1a1 --}}
        {{-- {{$user->musician->stagename}}  --}}


        
    </div>
    <div class="messages">
        <h2>Vedi i tuoi messaggi</h2>
    </div>
    <div class="reviews">
        <h2>Vedi le recensioni</h2>
    </div>
    <div class="sponsor">
        <h2>Scegli il piano di sponsorizzazione</h2>
    </div>

</div>
@endsection
