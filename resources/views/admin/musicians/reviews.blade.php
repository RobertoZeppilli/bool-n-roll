@extends('layouts.app')
@section('title')
    <title>Bool 'n' Roll - Recensioni {{ $user->musician->stagename }}</title>
@endsection

@section('content')
<div class="container py-5">
    
        @if (count($user->musician->reviews) > 0)
            <h1 class="pb-5">{{$user->musician->stagename}} le {{ $user->musician->typology == 'Band' ? 'vostre ' : 'tue' }} recensioni</h1>
            @foreach ($user->musician->reviews->sortByDesc('created_at') as $review)
                <div class="card w-100 my-2 card_review shadow p-3 mb-2 bg-body rounded">
                    <div class="card-body">
                        <h5 class="card-title"><span>Inviata da:</span> {{ $review->name }} {{ $review->surname ? $review->surname[0] . '.' : '' }}</h5>

                        <i class="fas fa-bullhorn fa-4x my-3"></i>
                        <p class="card-text font-italic">{{ $review->review }}</p>
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="star {{ $i <= $review->vote ? 'fas fa-star' : 'far fa-star' }}"></i>
                        @endfor
                        <div class="mb-4">
                            <em class="d-block date text-right">Inviata il: {{ date('d-m-Y \a\l\l\e H:i:s', strtotime($review->created_at)) }}</em>
                        </div>
                    </div>
                </div>

                <div class="pt-5">
                    <a class="btn btn-yellow text-white" href="{{ route('admin.welcome') }}">
                        Indietro
                    </a>
                </div>
            @endforeach
        @else
        <div class="main-height d-flex align-items-center justify-content-center">
            <div class="card text-center d-flex align-items-center justify-content-center p-5 card_review shadow p-3 mb-2 bg-body rounded">
                <div class="check_container d-flex align-items-center justify-content-center">
                    <i class="far fa-frown title-orange fa-4x"></i>
                </div>
                
                <div>
                    <h1 class="my-5">Non hai ancora ricevuto recensioni!</h1>
                    <p>Sponsorizza il tuo profilo, per renderti più visibile!</p>
                </div>
                <div class="w-100 d-flex justify-content-between">
                    <a class="btn btn-yellow text-white" href="{{ route('admin.welcome') }}">
                        Indietro
                      </a>
                    <a class="btn btn-orange text-white" href="{{ route('admin.musicians.sponsor', $user->musician->slug) }}">Sponsorizza</a>

                </div>
              </div>

        </div>
        @endif
    
    
</div>
@endsection