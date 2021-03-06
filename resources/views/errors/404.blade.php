@extends('layouts.app')

@section('content')
{{-- <div class="container py-5">
    <section class="main-height text-center">
        <h1>404</h1>
        <h2>Not Found</h2>
        <p class="mt-4">
            Oops, qualcosa è andato storto
            <br>La risorsa che stavi cercando non è disponibile.
        </p>
        {{-- <a class="btn btn-secondary text-light" href="{{ route('admin.posts.index') }}">
            <i class="fas fa-arrow-left"></i>
        </a> --}}
  
<div class="container d-flex align-items-center justify-content-center">
    <div class="main-height d-flex align-items-center justify-content-center">
        <div class="card text-center d-flex align-items-center justify-content-center p-5 card_review shadow p-3 mb-2 bg-body rounded">
          <div class="check_container d-flex align-items-center justify-content-center">
            <i class="far fa-question-circle  animate__animated animate__rotateIn fa-4x title-orange"></i>
          </div>
    
          <h1 class="my-5 text-danger">Errore 404</h1>
          <p>Oops, qualcosa è andato storto
            <br>La risorsa che stavi cercando non è disponibile.</p>
    
          <a class="btn btn-orange text-white my-3" href="/">
            Indietro
          </a>      
        </div>

    </div>
  </div>
    
@endsection