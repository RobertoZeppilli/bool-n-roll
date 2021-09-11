<?php

namespace App\Http\Controllers\Admin;

use Braintree\Transaction;
use App\Sponsorship;

use Braintree;


use Illuminate\Support\Facades\DB;


use Illuminate\Support\Carbon;

use App\Musician;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    // public function make(Request $request) {
    //     $payload = $request->input('payload', false);
    //     $nonce = $payload['nonce'];
    //     $status = Transaction::sale([
    //                             'amount' => '10.00',
    //                             'paymentMethodNonce' => $nonce,
    //                             'options' => ['submitForSettlement' => True]
    //                             ]);
    //     return response()->json($status);
    // }

    public function payment(Request $request, Sponsorship $sponsorship)
    {

        $data = $request->all();
        // dd($data['price']);

        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $amount = $data['price'];
        // dd($amount);c
        $nonce = 'fake-valid-nonce';

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            // 'customer' => [
            //     'firstName' => 'Tony',
            //     'lastName' => 'Stark',
            //     'email' => 'tony@avengers.com',
            // ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);


        if ($result->success) {
            $transaction = $result->transaction;
            // header("Location: transaction.php?id=" . $transaction->id);

            $musician = Musician::where('user_id', Auth::id())->first();

            $sponsorship = Sponsorship::where('price', $data['price'])->first();

            $end_date = Carbon::now('Europe/Rome')->addHour($sponsorship->duration);
            $created_at = Carbon::now('Europe/Rome');

            // dd($sponsorship);
            
            
            $musician->sponsorships()->attach($musician, [
                'sponsorship_id' => $sponsorship->id,
                'musician_id' => $musician->id,
                'end_date' => $end_date,
                'created_at' => $created_at
            ]);


            return back()->with('success_message', 'Transazione avvenuta con successo. L\'ID è: ' . $transaction->id);
        } else {
            $errorString = "";

            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Errore: ' . $error->code . ": " . $error->message . "\n";
            }

            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return back()->withErrors('C\'è stato un errore: ' . $result->message);
        }
    }
}
