@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$user->name}} ui puoi creare il tuo profilo</h1>

    <div class="card-container">
        <form action="{{route('admin.musicians.store', $user->musician->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

            <div class="form-group">
                <label for="stagename">Nome d'Arte</label>
                <input class="form-control" type="text" placeholder="Inserisci il nome d'arte" name="stagename" value="{{old('stagename')}}">
                @error('stagename')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="bio">La tua biografia</label>
                <textarea class="form-control" id="bio" rows="5" name="bio">{{old('bio')}}</textarea>
                @error('bio')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="services">Servizi</label>
                <textarea class="form-control" id="services" rows="5" name="services">{{old('services')}}</textarea>
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
                        {{-- @if ($errors->any())
                            <input class="form-check-input" name='genres[]' type="checkbox" value="{{ $genre->id }}" id="genre-{{$genre->id}}" {{ in_array($genre->id, old('genres', [])) ? 'checked' : '' }}>
                            <label class="form-check-label" for="genre-{{ $genre->id }}">
                            {{ $genre->name }}
                            </label>
                        @else  --}}
                            {{-- <input class="form-check-input" name='genres[]' type="checkbox" value="{{ $genre->id }}" id="genre-{{$genre->id}}" {{ $musician->genres->contains($genre->id) ? 'checked' : '' }}>
                        @endif
                            <label class="form-check-label" for="genre-{{ $genre->id }}">
                            {{ $genre->name }}
                            </label> --}}
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

            
            <button class="btn btn-primary" type="submit" >Modifica</button>
            
            
            {{-- <a class="btn btn-success" href="{{route('admin.musicians.index', $musician->id)}}">Torna alla Dashboard</a> --}}
            
            
        </form>
        

    </div>
</div>
@endsection