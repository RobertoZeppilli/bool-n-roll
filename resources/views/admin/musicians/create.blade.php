@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crea profilo</h1>
    <form action="{{route('admin.musicians.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="stagename">Nome d'arte</label>
            <input type="text" class="form-control" id="stagename" placeholder="Inserisci il nome" name="stagename">
            @error('stagename')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="typology">Tipologia</label>
            <input type="text" class="form-control" id="typology" placeholder="Inserisci l'indirizzo" name="typology">
            @error('typology')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea type="text" class="form-control" id="bio" placeholder="Inserisci la descrizione" name="bio" rows="6"></textarea>
            @error('bio')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="services">services</label>
            <textarea type="text" class="form-control" id="services" placeholder="Inserisci la descrizione" name="services" rows="6"></textarea>
            @error('services')
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            <h6>Generi Musicali</h6>
            @foreach ($genres as $genre)
                <div class="form-check form-check-inline">
                        <input class="form-check-input" name='genres[]' type="checkbox" value="{{ $genre->id }}" id="genre-{{$genre->id}}" {{ in_array($genre->id, old('genres', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="genre-{{ $genre->id }}">
                        {{ $genre->name }}
                        </label>
                </div>
            @endforeach
            @error('genres')
                <small class="text-danger d-block">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit" value="Submit">Crea</button>
    </form>
</div>


@endsection