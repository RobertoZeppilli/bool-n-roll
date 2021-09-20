@extends('layouts.app')

@section('content')

<div class="main-height d-flex align-items-center justify-content-center">

    @if (session('success_message'))
        <div class="alert alert-success animate__animated animate__zoomIn" style="width: max-content;">
            <small>{{ session('success_message')}}</small>
        </div>
    @endif
    <div class="card text-center d-flex align-items-center justify-content-center p-5 card_review shadow p-3 mb-2 bg-body rounded">
        <div class="check_container d-flex align-items-center justify-content-center">
            <i class="fas fa-thumbs-up fa-4x title-orange animate__animated animate__rotateIn" ></i>
        </div>
        
        <div>
            <h1 class="my-5">La sponsorizzazione è avvenuta con successo</h1>
            <p>Ora il tuo profilo sarà messo in evidenza nella home del sito!</p>
        </div>
        <div class="w-100 d-flex justify-content-center">
            <a class="btn btn-yellow text-white" href="{{ route('admin.welcome') }}">
                Indietro
            </a>
            {{-- <a class="btn btn-orange text-white" href="{{ route('admin.musicians.sponsor', $user->musician->slug) }}">Sponsorizza</a> --}}

        </div>
    </div>
</div>
    
@endsection