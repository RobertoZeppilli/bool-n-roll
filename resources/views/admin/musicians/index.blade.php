@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Benvenutooooo {{ $user->name }}</h1>
    {{-- questo è per capire se prendevo dati dalla relazione 1a1 --}}
    {{-- {{$user->musician->stagename}}  --}}
    <div class="card-container d-flex">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">Crea Profilo</h5>
            <p class="card-text">Clicca qui per vedere creare il tuo profilo completo</p>
            {{-- la rotta prende l'id del musicista legato all'utente autenticato --}}
            <a class="btn btn-primary" href="{{ route('admin.musicians.create', $user->id) }}">Vedi il profilo</a>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">Il tuo Profilo</h5>
            <p class="card-text">Clicca qui per vedere il tuo profilo completo</p>
            {{-- la rotta prende l'id del musicista legato all'utente autenticato --}}
            <a class="btn btn-primary" href="{{ route('admin.musicians.show', $user->id) }}">Vedi il profilo</a>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">Modifica Profilo</h5>
            <p class="card-text">Clicca qui per vedere il tuo profilo completo</p>
            <a class="btn btn-primary" href="{{ route('admin.musicians.edit', $user->id) }}">Modifica profilo</a>
            </div>
        </div>
        {{-- <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">I tuoi messaggi</h5>
            <p class="card-text">Clicca qui per vedere i messaggi ricevuti</p>
            <a class="btn btn-primary" href="{{ route('admin.musicians.messages', $user->musician->id) }}">Vai ai messaggi</a>
            </div>
        </div> --}}
        {{-- <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">Le tue Recensioni</h5>
            <p class="card-text">Clicca qui per vedere le recensioni ricevute</p>
            <a class="btn btn-primary" href="{{ route('admin.musicians.reviews', $user->musician->id) }}">Vai alle recensioni</a>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">Sponsorizzazioni</h5>
            <p class="card-text">Clicca qui per boostare il tuo profilo</p>
            <a class="btn btn-primary" href="{{ route('admin.musicians.sponsor', $user->musician->id) }}">Sponsorizza</a>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
            <h5 class="card-title">Statistiche</h5>
            <p class="card-text">Clicca qui per vedere le tue statistiche mensili</p>
            <a class="btn btn-primary" href="{{ route('admin.musicians.stats', $user->musician->id) }}">Statistiche</a>
            </div>
        </div> --}}
        

    </div>
</div>
@endsection