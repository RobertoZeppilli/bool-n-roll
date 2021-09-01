@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sponsorizza il tuo profilo!</h1>
        <p>Scegli il piano più adatto a te.</p>
        
        <div class="row">
            @foreach ($sponsorships as $sponsorship)
                <div class="col-xs-12 col-md-4 col-lg-4">
                    <div class="card p-4 shadow mb-2 text-center">
                        @if ($sponsorship->name == 'Oro')
                            <i class="fas fa-compact-disc gold fa-4x text-center"></i>
                        @elseif($sponsorship->name == 'Platino')   
                            <i class="fas fa-compact-disc platinum fa-4x text-center"></i>
                        @else 
                            <i class="fas fa-compact-disc diamond fa-4x text-center"></i>    
                        @endif
                        <div class="card-body">
                        <h5 class="card-title">{{ $sponsorship->name }}</h5>
                        <p class="card-text">{{ $sponsorship->description }}</p>
                        <a href="#" class="btn btn-yellow text-white">{{ $sponsorship->price }} &euro;</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a class="btn btn-secondary" href="{{ route('admin.welcome') }}">
                <i class="far fa-hand-point-left text-white"></i>
            </a>
        </div>
    </div>
@endsection