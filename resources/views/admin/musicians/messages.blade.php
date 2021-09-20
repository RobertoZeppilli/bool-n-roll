@extends('layouts.app')

@section('title')
    <title>Bool 'n' Roll - Messaggi {{ $user->musician->stagename }}</title>
@endsection


@section('content')
    <div class="container py-5">
        @if (count($user->musician->messages) > 0)
            <h1 class="pb-3 heading-title">{{$user->musician->stagename}} i {{ $user->musician->typology == 'Band' ? 'vostri ' : 'tuoi' }} messaggi</h1>
            @foreach ($user->musician->messages->sortByDesc('created_at') as $message)
                <div  class="card rounded shadow mb-3 ">
                    <div class="card-body  style-single">
                        <div class="mb-4">
                            {{-- <div class="d-flex justify-content-between"> --}}
                                
                                <div class="date py-2 text-right">Ricevuto il: {{ date('d-m-Y \a\l\l\e H:i:s', strtotime($message->created_at)) }}</div>
                                <h5 class="card-title">
                                    <span class="title-orange">Inviato da:</span>
                                     {{ $message->name }} {{ $message->surname ? ucfirst($message->surname[0]) . '.' : '' }}
                                </h5>
                            {{-- </div> --}}
                            <h6 class="text-left font-italic platinum">{{ $message->email }}</h6>
                            
                        </div>
                        @if ($message->readed != 0)
                            <p class="card-text message text-left">{{ $message->message }}</p>
                            <small class="text-success small-position">Letto</small>
                        @else
                            <small class="text-danger small-position">Non letto</small>
                            <form method="POST" action="{{ route('admin.read', $message->id) }}">
                                @csrf 
                                @method('PUT')

                                {{-- <input type="hidden" name="message" value="{{ $message->id }}"/> --}}
                                <button class="btn btn-info text-white" type="submit">
                                    Leggi
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="pt-5">
                <a class="btn btn-yellow text-white" href="{{ route('admin.welcome') }}">
                    Indietro
                </a>
            </div>
        @else
            <div class="main-height d-flex align-items-center justify-content-center">
                <div class="card text-center d-flex align-items-center justify-content-center p-5 card_review shadow p-3 mb-2 bg-body rounded">
                    <div class="check_container d-flex align-items-center justify-content-center">
                        <i class="far fa-frown title-orange fa-4x animate__animated animate__bounceIn"></i>
                    </div>
                    
                    <div>
                        <h1 class="my-5">Non hai ancora ricevuto messaggi!</h1>
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

@push('script')
    <script>
        function readMessage(id) {

        }
    </script>
@endpush
    
    


