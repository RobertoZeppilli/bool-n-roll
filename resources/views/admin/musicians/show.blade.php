@extends('layouts.app')

@section('title')
    <title>Bool 'n' Roll - Profilo {{ $musician->stagename }}</title>
@endsection

@section('content')

    
    <div class="pattern"></div>
    <div class="container py-5 myContainer">
        
        <div class="position d-flex align-items-center justify-content-center">
            <img class="profile-img" src="{{ asset('storage/'.$musician->cover) }}" alt="" />
        </div>
        @if (session('message'))
            <div class="alert alert-success animate__animated animate__zoomIn" style="width: max-content;">
                <small>{{ session('message') }}</small>
            </div>
        @endif
        <div class="pt-100 text-center">
            <h2 class="pb-3">Il profilo {{ $musician->typology == 'Band' ? 'dei ' . $musician->stagename : 'di ' . $musician->stagename  }}</h2>

            
                @if ($musician->sponsorships)
                    <div class="my-4">
                        @foreach ($musician->sponsorships as $sponsorship)
                            @if (Illuminate\Support\Carbon::now('Europe/Rome') <= $sponsorship->pivot->end_date && $loop->last) 
                                <div class="p-3 rounded">
                                    <span class="badge badge-success text-white p-2 sponsor-size">Il {{ $musician->typology == 'Band' ? 'vostro ' : 'tuo '  }} profilo è sponsorizzato fino al {{$sponsorship->pivot->end_date}}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
           
            
            @foreach ($musician->genres as $genre)
                <span class="badge_profile badge badge-purple text-white mr-2">{{$genre->name}}</span>   
            @endforeach

            <h4 class="title-petrol text-uppercase font-weight-bold my-3 mt-5">Bio</h4>
            <p>{{ $musician->bio }}</p>

            <h4 class="title-wine text-uppercase font-weight-bold my-3 mt-5">I nostri servizi</h4>
            <p>{{$musician->services}}</p>

            <h4 class="title-pink text-uppercase font-weight-bold my-3 mt-5">Tipologia di artista</h4>
            <p>{{$musician->typology}}</p>
        </div>

        <div class="pt-5 d-flex justify-content-between text-center">
            <a class="btn btn-yellow text-white" href="{{ route('admin.welcome') }}">
                Indietro
            </a>
            
            
            <a class="btn btn-orange text-white" href="{{ route('admin.musicians.edit', $musician->id) }}">Modifica</a>
            
    
            <div>
                
                <div id="delete" class="d-none animate__animated animate__fadeIn">
                    <div class="bg-nav rounded p-5">
                        <i class="fas fa-exclamation-triangle text-danger fa-4x"></i>
                        <h3 class="py-3">Sei sicuro di voler eliminare il tuo profilo?</h3>
                        <div class="w-100 d-flex justify-content-between">
                            <button class="btn btn-yellow text-white" onclick="closePopup()">
                                Chiudi
                            </button>
                            <form action="{{ route('admin.musicians.destroy', $musician->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                    
                                <button class="btn btn-danger" type="submit">Elimina</button>
                            </form>
        
                        </div>
                    </div>
        
                </div>
                <button class="btn btn-danger" id="toggle" onclick="popup()" type="submit">Elimina</button>

            </div>
        </div>
      
    </div>

    

@endsection

@push('script')
<script>
    // let open = false;
    let deleteForm = document.getElementById('delete');
    const popup = () => {
        deleteForm.classList.remove('d-none')
    }

    const closePopup = () => {
        deleteForm.classList.add('d-none')
        
    }

    
    
</script>
@endpush
