@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <h1>{{$user->name}} Qui puoi modificare il tuo profilo</h1>

    <div class="card-container">
        <form action="{{route('admin.musicians.update', $user->musician->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

            <div class="form-group">
                <label for="stagename">Nome d'Arte</label>
                <input class="form-control" type="text" placeholder="Inserisci il nome d'arte" name="stagename" value="{{old('stagename',$musician->stagename)}}">
                @error('stagename')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="bio">La tua biografia</label>
                <textarea class="form-control" id="bio" rows="5" name="bio">{{old('bio', $musician->bio)}}</textarea>
                @error('bio')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="services">Servizi</label>
                <textarea class="form-control" id="services" rows="5" name="services">{{old('services', $musician->services)}}</textarea>
                @error('services')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <form>
                <div class="form-group">
                  <label for="cover">Immagine di copertina</label>
                  <input type="file" class="form-control-file" id="cover" name="cover">
                  @error('cover')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </form>
            <div class="form-group">
                <label for="typology">Solista, Duo o Band?</label>
                <input class="form-control" type="text" placeholder="Default input" name="typology">
                @error('typology')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="form-group">
                <h6>Generi Musicali</h6>
                @foreach ($genres as $genre)
                    <div class="form-check form-check-inline">
                        @if ($errors->any())
                            <input class="form-check-input" name='genres[]' type="checkbox" value="{{ $genre->id }}" id="genre-{{$genre->id}}" {{ in_array($genre->id, old('genres', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="genre-{{ $genre->id }}">
                            {{ $genre->name }}
                            </label>
                        @else 
                            <input class="form-check-input" name='genres[]' type="checkbox" value="{{ $genre->id }}" id="genre-{{$genre->id}}" {{ $musician->genres->contains($genre->id) ? 'checked' : '' }}>
                        @endif
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
            <button class="btn btn-primary" type="submit" >Modifica</button>
            
            
            <a class="btn btn-success" href="{{route('admin.musicians.index', $musician->id)}}">Torna alla Dashboard</a>
            
            
        </form>
        

    </div>
</div> --}}

<div class="container">
    <h1>Modifica profilo</h1>
    <form action="{{route('admin.musicians.update', $musician->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

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

        <button class="btn btn-primary" type="submit" value="Submit">MODIFICA</button>
    </form>
</div>
@endsection