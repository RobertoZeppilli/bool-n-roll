@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
        <div class="alert alert-success">
            <h6>{{ session('message') }}</h6>
        </div>
    @endif
        <div class="row">
            <div class="col-xs-6 col-md-6 col-lg-6">
                <h2 class="py-2">Il profilo di {{ $musician->stagename }}</h2>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-6">
                @if ($musician->sponsorships)
                    @foreach ($musician->sponsorships as $sponsorship)
                        <div class="alert-success p-3 rounded">
                            Il tuo profilo è sponsorizzato fino al {{$sponsorship->pivot->end_date}}
                        </div>  
                    @endforeach
                @endif
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-xs-12 col-md-6 col lg-6">
                <img class="img-fluid rounded shadow-lg" src="{{ asset('storage/'.$musician->cover) }}" alt="">
            </div>
            <div class="col-xs-12 col-md-6 col-lg-6">

                <div class="mb-2">
                    <h5 class="title-yellow">Nome d'arte <span><i class="fas fa-palette"></i></span></h5>
                    <p>{{ $musician->stagename }}</p>
                </div>
                
                <div class="mb-2">
                    <h5 class="title-wine">Servizi <span><i class="fas fa-business-time"></i></span></h5>
                    <p>{{ $musician->services }}</p>
                </div>

                <div class="mb-2">
                    <h5 class="title-petrol">Biografia <span><i class="fas fa-users"></i></span></h5>
                    <small>{{ $musician->bio }}</small>
                </div>

                <div class="mb-2">
                    <h5 class="title-pink">Tipologia <span><i class="fas fa-guitar"></i></span></h5>
                    <p>{{ $musician->typology }}</p>
                </div>
                
                <div>
                    <h5 class="title-orange">Generi <span><i class="fas fa-tasks"></i></span></h5>
                    <ul class="m-0 p-0 d-flex">
                        @foreach ($musician->genres as $genre)
                        <li class="badge badge-purple text-white mr-2">{{ $genre->name }}</li> 
                        @endforeach
                    </ul> 
                </div>
                
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
