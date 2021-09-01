@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
        <div class="alert alert-success">
            <h6>{{ session('message') }}</h6>
        </div>
    @endif
    <h1 class="mb-4">Benvenuto {{ ucfirst($user->name) }}</h1>
    
    {{-- @dd($musician) --}}
    <div class="row">
        <div class="col-xs-6 col-md-4 col-lg-4 mb-4">
            <div class="card shadow p-4">
                <i class="fas fa-eye card-image-top fa-4x text-center title-purple"></i>
                <div class="card-body text-center  ">
                  <h5 class="card-title">Profilo</h5>
                  <a class="btn btn-purple text-white" href="{{ route('admin.musicians.show', $user->musician->id) }}">Mostra</a>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-4 col-lg-4 mb-4">
            <div class="card shadow p-4">
                <i class="far fa-address-card card-image-top fa-4x text-center title-indigo"></i>
                <div class="card-body text-center ">
                  <h5 class="card-title">Crea profilo</h5>
                  <a class="btn btn-indigo text-white" href="{{ route('admin.musicians.create', $user->id) }}">Crea</a>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-4 col-lg-4 mb-4">
            <div class="card shadow p-4">
                <i class="far fa-envelope card-image-top fa-4x text-center title-cyan"></i>
                <div class="card-body text-center ">
                  <h5 class="card-title">Messaggi</h5>
                  <a class="btn btn-cyan text-white">Messaggi</a>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-4 col-lg-4 mb-4">
            <div class="card shadow p-4">
                <i class="fas fa-rocket card-image-top fa-4x text-center title-green"></i>
                <div class="card-body text-center ">
                  <h5 class="card-title">Sponsorizza</h5>
                  <a class="btn btn-green text-white">Sponsorizza</a>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-4 col-lg-4 mb-4">
            <div class="card shadow p-4">
                <i class="fas fa-chart-pie card-image-top fa-4x text-center title-red"></i>
                <div class="card-body text-center ">
                  <h5 class="card-title">Statistiche</h5>
                  <a class="btn btn-red text-white">Statistiche</a>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-4 col-lg-4 mb-4">
            <div class="card shadow p-4">
                <i class="far fa-comments card-image-top fa-4x text-center title-teal"></i>
                <div class="card-body text-center ">
                  <h5 class="card-title">Recensioni</h5>
                  <a class="btn btn-teal text-white">Recensioni</a>
                </div>
            </div>
        </div>
    </div> 

</div>
@endsection
