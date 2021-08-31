@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
        <div class="alert alert-success">
            <h6>{{ session('message') }}</h6>
        </div>
    @endif
    SHOW PROFILO

    <img class="img-fluid" src="{{ asset('storage/'.$musician->cover) }}" alt="">
    <p>Nome d'arte: {{ $musician->stagename }}</p>
    {{-- @dd($musician) --}}
    <p>Servizi: {{ $musician->services }}</p>
    <p>Bio: {{ $musician->bio }}</p>
    <p>Tipologia: {{ $musician->typology }}</p>

    <h2>Generi</h2>
    @if ($musician->genres)
        <ul>
            @foreach ($musician->genres as $genre)
            <li>{{ $genre->name }}</li> 
            @endforeach
        </ul> 
    @endif

    <div class="edit_profile">
        <a href="{{ route('admin.musicians.edit', $musician->id) }}">Modifica il tuo profilo</a>
    </div>

    <div>
        <a href="{{ route('admin.welcome') }}">Torna alla dashboard</a>
    </div>

    {{-- <div>
        <h2>Nome</h2>
        <h3>{{$musician->name}}</h3>
    </div>
    <div>
        <h2>Cognome</h2>
        <h3>{{$musician->surname}}</h3>
    </div>
    <div>
        <h2>Email</h2>
        <h3>{{$musician->address}}</h3>
    </div> --}}
</div>
@endsection
