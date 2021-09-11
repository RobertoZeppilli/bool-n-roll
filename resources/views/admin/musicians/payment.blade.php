@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div id="dropin-container">
                <form method="post" id="payment-form" action="{{url('/checkout')}}">
                    @csrf
                    @method('POST')
                    <section>
                        {{$sponsorship}}
                        <label for="amount">
                            <span class="input-label">Amount</span>
                            <div class="input-wrapper amount-wrapper">
                                <input id="amount" name="amount" type="tel" placeholder="Amount" value="{{ $sponsorship->price }}" disabled>
                            </div>
                        </label>
        
                        <div class="bt-drop-in-wrapper">
                            <div id="bt-dropin"></div>
                        </div>
                    </section>
        
                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                    <button class="button" type="submit"><span>Test Transaction</span></button>
                </form>
            </div>
            <button id="submit-button">Request payment method</button>
        </div>
    </div>
</div>


@endsection

<script>
    var form = document.querySelector('#payment-form');
    var client_token = "{{ $token }}";
    braintree.dropin.create({
        authorization: client_token,
        selector: '#bt-dropin',
        // paypal: {
        // flow: 'vault'
        // },
        // option : {
        //     verifyCard : true
        // } 
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

