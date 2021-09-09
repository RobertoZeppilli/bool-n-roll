@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{$user->name}} le tue recensioni</h1>
    {{-- {{$user->musician->messages}} --}}
    
        @if (count($user->musician->reviews) > 0)
            @foreach ($user->musician->reviews as $review)
                
                    <div class="card w-100 my-2 card_review shadow p-3 mb-2 bg-body rounded">
                        {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                        <div class="card-body">
                            <h5 class="card-title"><span>Inviata da:</span> {{ $review->name }}</h5>
                            {{-- <i class="fas fa-megaphone"></i> --}}
                            <i class="fas fa-bullhorn fa-4x mb-2 my-3"></i>
                            <p class="card-text font-italic">{{ $review->review }}</p>
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="star {{ $i <= $review->vote ? 'fas fa-star' : 'far fa-star' }}"></i>
                            @endfor
                            <div class="mb-4">
                                <em class="d-block date text-right">Inviata il: {{ date('d-m-Y \a\l\l\e H:i:s', strtotime($review->created_at)) }}</em>
                            </div>
                        </div>
                    </div>
               
            @endforeach
        @else
            <div class="col-xs-12 col-md-12 col-lg-12">
                <h2>Attualmente non hai ricevuto recensioni</h2>
            </div>
        @endif
    
    <div>
        <a class="btn btn-petrol" href="{{ route('admin.welcome') }}">
            <i class="far fa-hand-point-left text-white"></i>
        </a>
    </div>
</div>
@endsection