@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$user->name}} i tuoi messaggi</h1>
        {{-- {{$user->musician->messages}} --}}
        <div class="row">
            @if (count($user->musician->messages) > 0)
                @foreach ($user->musician->messages as $message)
                    <div class="col-xs-12 col-md-4 col-lg-4">
                        <div class="card myCard rounded shadow">
                            {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                            <div class="card-body text-center ">
                                <div class="mb-4">
                                    <h5 class="card-title"><span>Inviato da:</span> {{ $message->name }}</h5>
                                    <h6>{{ $message->email }}</h6>
                                    <em class="d-block date">Inviato il: {{ date('d-m-Y \a\l\l\e H:i:s', strtotime($message->created_at)) }}</em>
                                </div>
                                <i class="fas fa-envelope-open-text fa-4x mb-2"></i>
                                <p class="card-text">{{ $message->message }}</p>
                            </div>

                            
                            {{-- <i class="fas fa-megaphone"></i> --}}
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-xs-12 col-md-12 col-lg-12">
                    <h2>Non ci sono messaggi, pezzente!</h2>
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