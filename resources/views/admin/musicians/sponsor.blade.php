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
                    <a class="btn btn-petrol" href="{{ route('admin.welcome') }}">
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