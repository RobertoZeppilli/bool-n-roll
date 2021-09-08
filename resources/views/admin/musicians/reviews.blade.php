@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$user->name}} le tue recensioni</h1>
    {{-- {{$user->musician->messages}} --}}
    <div class="row">
        @if (count($user->musician->reviews) > 0)
            @foreach ($user->musician->reviews as $review)
                <div class="col-xs-12 col-md-4 col-lg-4">
                    <div class="card myCard rounded shadow">
                        {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                        <div class="card-body text-center ">
                            <div class="mb-4">
                                <h5 class="card-title"><span>Inviata da:</span> {{ $review->name }}</h5>
                                <em class="d-block date">Inviata il: {{ date('d-m-Y \a\l\l\e H:i:s', strtotime($review->created_at)) }}</em>
                            </div>
                            {{-- <i class="fas fa-megaphone"></i> --}}
                            <i class="fas fa-bullhorn fa-4x mb-2"></i>
                            <p class="card-text">{{ $review->review }}</p>
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="star {{ $i <= $review->vote ? 'fas fa-star' : 'far fa-star' }}"></i>
                            @endfor
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-xs-12 col-md-12 col-lg-12">
                <h2>Non ci sono recensioni, pezzente!</h2>
            </div>
        @endif
    </div>
    <div>
        <a class="btn btn-petrol" href="{{ route('admin.welcome') }}">
            <i class="far fa-hand-point-left text-white"></i>
        </a>
    </div>
</div>
@endsection