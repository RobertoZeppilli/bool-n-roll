@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ciao {{ ucfirst($user->name) }}, crea il tuo profilo!</h1>
    <form action="{{ route('admin.musicians.store', $musician->id) }}" method="POST" class="mt-3" enctype="multipart/form-data"> 

        @csrf
        @method('POST')
        
        <div class="form-group">
            <label for="stagename">Nome d'arte</label>
            <input type="text" class="form-control @error('stagename') is-invalid @enderror" name="stagename" id="stagename" value="{{ old('stagename') }}">
            @error('stagename')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="typology">Tipologia</label>
            <input type="text" class="form-control @error('typology') is-invalid @enderror" name="typology" id="typology" value="{{ old('typology') }}">
            @error('typology')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="bio">Biografia</label>
            <textarea name="bio" id="bio" class="form-control @error('bio') is-invalid @enderror" rows="10">{{ old('bio') }}</textarea>
            @error('bio')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="services">Servizi</label>
            <textarea name="services" id="services" class="form-control @error('services') is-invalid @enderror" rows="10">{{ old('services') }}</textarea>
            @error('services')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="cover">Cover</label>
            @if ($musician->cover)
                <div class="mb-3">
                    <small class="d-block">Actual Cover</small>
                    <img style="width:100px;" src="{{ asset('storage/'.$musician->cover) }}" alt="{{ $musician->stagename }}">
                </div>
            @endif
            {{-- preview of the cover before creating  --}}
            <input name="cover" type="file" id="cover" class="form-control-file mb-2" accept="image/*" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
            <img id="preview" style="object-fit: cover;" src="" width="300">
            {{-- /preview of the cover before creating  --}}
            @error('cover')
                <small class="text-danger d-block">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="form-group">
            <h6>Genres</h6>
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


        

        <div class="d-flex justify-content-between align-items-center">
            <a class="btn btn-petrol" href="{{ route('admin.welcome') }}">
                <i class="far fa-hand-point-left text-white"></i>
            </a>
            <button type="submit" class="btn btn-primary my-5">
                Save
            </button>
        </div>
    </form>
    
</div>
@endsection