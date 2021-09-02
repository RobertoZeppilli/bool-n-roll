<?php

namespace App\Http\Controllers\Admin;

use Braintree\Transaction;
use App\Sponsorship;

use Braintree;

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

    public function payment(Request $request) {
       
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
    
            return back()->with('success_message', 'Transaction successful. The ID is: '. $transaction->id);
        } else {
            $errorString = "";
    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
    
            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return back()->withErrors('An error occurred with the message: '.$result->message);
        }
    }
}
