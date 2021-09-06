@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
        <div class="alert alert-success">
            <h6>{{ session('message') }}</h6>
        </div>
    @endif
    <div class="py-4">
        <h1>{{ str_ends_with($user->name, 'a') ? 'Benvenuta' : 'Benvenuto' }} {{ ucfirst($user->name) }}</h1>
    </div>
    
    <div class="row">
        @if($user->musician)
            <div class="col-xs-6 col-md-6 col-lg-4 mb-4">
                <div class="card shadow p-4 prova">
                    <i class="fas fa-eye card-image-top fa-4x text-center title-purple"></i>
                    <div class="card-body text-center  ">
                    <h5 class="card-title">Profilo</h5>
                    <p class="title-purple bg-pale rounded py-2">Vedi il tuo profilo, modificalo o eliminalo.</p>
                    
                        <a class="btn btn-purple text-white" href="{{ route('admin.musicians.show', $user->musician->id) }}">Mostra</a>
                    </div>
                </div>
            </div>    
            <div class="col-xs-6 col-md-6 col-lg-4 mb-4">
                <div class="card shadow p-4 prova">
                    <i class="far fa-envelope card-image-top fa-4x text-center title-petrol"></i>
                    <div class="card-body text-center ">
                      <h5 class="card-title">Messaggi</h5>
                      <p class="bg-pale title-petrol py-2 rounded">Qui troverai tutti i messaggi in entrata.</p>
                      <a class="btn btn-petrol text-white">Messaggi</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-4 mb-4">
                <div class="card shadow p-4 prova">
                    <i class="fas fa-rocket card-image-top fa-4x text-center title-green"></i>
                    <div class="card-body text-center ">
                      <h5 class="card-title">Sponsorizza</h5>
                      <p class="bg-pale title-green py-2 rounded">Sponsorizza il tuo profilo, basta un click!</p>
                      <a href="{{ route('admin.musicians.sponsor', $user->musician->id) }}" class="btn btn-green text-white">Sponsorizza</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-4 mb-4">
                <div class="card shadow p-4 prova">
                    <i class="fas fa-chart-pie card-image-top fa-4x text-center title-yellow"></i>
                    <div class="card-body text-center ">
                      <h5 class="card-title">Statistiche</h5>
                      <p class="title-yellow bg-pale rounded py-2">Tieniti aggiornato sulle statistiche.</p>
                      <a class="btn btn-yellow text-white">Statistiche</a>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-4 mb-4">
                <div class="card shadow p-4 prova">
                    <i class="far fa-comments card-image-top fa-4x text-center title-wine"></i>
                    <div class="card-body text-center ">
                      <h5 class="card-title">Recensioni</h5>
                      <p class="title-wine rounded bg-pale py-2">Qui potrai leggere le recensioni su di te.</p>
                      <a class="btn btn-wine text-white">Recensioni</a>
                    </div>
                </div>
            </div>
          
        @elseif(!$user->musician)
            <div class="col-xs-6 col-md-6 col-lg-4 mb-4">
                <div class="card shadow p-4 prova">
                    <i class="far fa-address-card card-image-top fa-4x text-center title-pink"></i>
                    <div class="card-body text-center ">
                    <h5 class="card-title">Crea profilo</h5>
                    <p class="title-pink bg-pale rounded py-2">Crea subito il tuo profilo da musicista!</p>
                    <a class="btn btn-pink text-white" href="{{ route('admin.musicians.create', $user->id) }}">Crea</a>
                    </div>
                </div>
            </div>
        @endif
    </div> 

</div>
@endsection
