@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}
    <h1>Dashboard musicista</h1>

    <div class="profile">
        <h2>Vedi il tuo profilo</h2>
        
        {{-- la rotta prende l'id del musicista legato all'utente autenticato --}}
        <a class="btn btn-warning" href="{{ route('admin.musicians.show', $user->musician->id) }}">Vedi il profilo</a>
        {{ $user->name }}
        {{$user->id}}

        {{-- questo è per capire se prendevo dati dalla relazione 1a1 --}}
        {{$user->musician->stagename}} 


        
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