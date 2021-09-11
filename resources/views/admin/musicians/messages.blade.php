@extends('layouts.app')

@section('title')
    <title>Bool 'n' Roll - Messaggi {{ $user->musician->stagename }}</title>
@endsection

@section('content')
    <div class="container">
        <h1>{{$user->musician->stagename}} i {{ $user->musician->typology == 'Band' ? 'vostri ' : 'tuoi' }} messaggi</h1>
        
                @if (count($user->musician->messages) > 0)
                    @foreach ($user->musician->messages as $message)
                        
                            <div class="card rounded shadow mb-3">
                                
                                <div class="card-body text-center">
                                    <div class="mb-4">
                                        <h5 class="card-title"><span>Inviato da:</span> {{ $message->name }} {{ $message->surname ? $message->surname[0] . '.' : '' }}</h5>
                                        <h6>{{ $message->email }}</h6>
                                        <em class="d-block date">Inviato il: {{ date('d-m-Y \a\l\l\e H:i:s', strtotime($message->created_at)) }}</em>
                                    </div>
                                    <i class="fas fa-envelope-open-text fa-4x mb-2"></i>
                                    
                                    <p class="card-text">{{ $message->message }}</p>
                                    
                                </div>
    
                                
                                
                            </div>
                        
                    @endforeach
                @else
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <h2>Non ci sono messaggi, pezzente!</h2>
                    </div>
                @endif
           
        <div>
            <a class="btn btn-petrol" href="{{ route('admin.welcome') }}">
                <i class="far fa-hand-point-left text-white"></i>
            </a>
        </div>
    </div>
@endsection



