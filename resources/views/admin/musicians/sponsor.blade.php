@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success_message'))
  <div class="alert alert-success">
    {{ session('success_message')}}
  </div>
  @endif
  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
        <h1>Sponsorizza il tuo profilo!</h1>
        <p>Scegli il piano più adatto a te.</p>
        
        {{-- <div class="row">
            @foreach ($sponsorships as $sponsorship)
                <div class="col-xs-12 col-md-4 col-lg-4">
                    <div class="card p-4 shadow mb-2 text-center">
                        @if ($sponsorship->name == 'Oro')
                            <i class="fas fa-compact-disc gold fa-4x text-center"></i>
                        @elseif($sponsorship->name == 'Platino')   
                            <i class="fas fa-compact-disc platinum fa-4x text-center"></i>
                        @else 
                            <i class="fas fa-compact-disc diamond fa-4x text-center"></i>    
                        @endif
                        <div class="card-body">
                        <h5 class="card-title">{{ $sponsorship->name }}</h5>
                        <p class="card-text">{{ $sponsorship->description }}</p>
                        <a href="{{ route('admin.musicians.payment', $sponsorship->price) }}" class="btn btn-yellow text-white">{{ $sponsorship->price }} &euro;</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}

        <div id="dropin-container">
            <form method="POST" id="payment-form" action="{{ route('admin.paga') }}">
                @csrf
                @method('POST')
                <section>
                    @foreach ($sponsorships as $sponsorship)
                        <div class="inputGroup">
                            <input type="radio" name="price" id="sponsorship-{{ $sponsorship->id }}" value="{{ $sponsorship->price }}">
                            <label class="clamp-size" for="sponsorship-{{ $sponsorship->id }}">
                                {{ $sponsorship->description }}
                            </label>
                        </div>
                    @endforeach
    
                    <div class="bt-drop-in-wrapper">
                        <div id="bt-dropin" class="text-center">
                        </div>
                    </div>
                </section>
                
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn btn-secondary" href="{{ route('admin.welcome') }}">
                        <i class="far fa-hand-point-left text-white"></i>
                    </a>
                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                    <button class="button btn btn-primary" type="submit">
                        Paga
                    </button>
                </div>
            </form>
        </div>
        
    </div>
    @section('script')
        <script src="https://js.braintreegateway.com/web/dropin/1.31.2/js/dropin.min.js"></script>
        <script>
            var form = document.querySelector('#payment-form');
            var client_token = "{{ $token }}";
            braintree.dropin.create({
                authorization: client_token,
                selector: '#bt-dropin',
            }, function (createErr, instance) {
                if (createErr) {
                console.log('Create Error', createErr);
                return;
                }
                form.addEventListener('submit', function (event) {
                event.preventDefault();
                instance.requestPaymentMethod(function (err, payload) {
                    if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                    }
                    // Add the nonce to the form and submit
                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
                });
            });
        </script>
    @endsection
@endsection