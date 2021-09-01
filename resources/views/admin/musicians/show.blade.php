@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
        <div class="alert alert-success">
            <h6>{{ session('message') }}</h6>
        </div>
    @endif
    <h2>Il profilo di {{ $musician->stagename }}</h2>
    
    
        <div class="row">
            <div class="col-xs-12 col-md-6 col lg-6">
                <img class="img-fluid rounded shadow-lg" src="{{ asset('storage/'.$musician->cover) }}" alt="">
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6">
                <p>Nome d'arte: {{ $musician->stagename }}</p>
        
                <p>Servizi: {{ $musician->services }}</p>
                <p>Bio: {{ $musician->bio }}</p>
                <p>Tipologia: {{ $musician->typology }}</p>
                
                <ul class="m-0 p-0 d-flex">
                    @foreach ($musician->genres as $genre)
                    <li class="badge badge-purple text-white mr-2">{{ $genre->name }}</li> 
                    @endforeach
                </ul> 
                
            </div>
        </div>
    
        <div class="mt-5 d-flex justify-content-between align-items-center">
            <a class="btn btn-secondary" href="{{ route('admin.welcome') }}">
                <i class="far fa-hand-point-left text-white"></i>
            </a>
            
            
            <a class="btn btn-orange text-white" href="{{ route('admin.musicians.edit', $musician->id) }}">Modifica</a>
            
    
            <div>
                <form action="{{ route('admin.musicians.destroy', $musician->id) }}" method="POST" onSubmit="return confirm('Are you sure you want to delete {{ $musician->stagename }}?')">
                    @csrf
                    @method('DELETE')
        
                    <button class="btn btn-danger" type="submit">Elimina</button>
                </form>
            </div>
        </div>
    
</div>
@endsection
