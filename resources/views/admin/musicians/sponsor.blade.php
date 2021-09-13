@extends('layouts.app')

@section('title')
    <title>Bool 'n' Roll - Sponsorizza</title>
@endsection

@section('content')
    <div class="container py-5">
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
        <h1 class="pb-3">Sponsorizza il tuo profilo!</h1>
        <p class="pb-4">Scegli il piano più adatto a te.</p>

        <div id="dropin-container">
            <form method="POST" id="payment-form" action="{{ route('admin.paga') }}">
                @csrf
                @method('POST')
                <section>
                    @foreach ($sponsorships as $sponsorship)
                        <div class="inputGroup">
                            <input type="radio" name="price" id="sponsorship-{{ $sponsorship->id }}" value="{{ $sponsorship->price }}">
                            <label class="clamp-size" for="sponsorship-{{ $sponsorship->id }}">
                                {{ $sponsorship->description }} Al prezzo di <span class="title-soft-green">{{ $sponsorship->price }} &euro;</span>
                            </label>
                        </div>
                    @endforeach
    
                    <div class="bt-drop-in-wrapper">
                        <div id="bt-dropin" class="text-center">
                        </div>
                    </div>
                </section>
                
                <div class="d-flex justify-content-between align-items-center pt-5">
                    <a class="btn btn-yellow text-white" href="{{ route('admin.welcome') }}">
                        Indietro
                    </a>
                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                    <button class="btn btn-orange text-white" type="submit">
                        Paga
                    </button>
                </div>
            </form>
        </div>
        
    </div>

    
@endsection

@push('script')
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
@endpush