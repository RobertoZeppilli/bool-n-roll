<?php

namespace App\Http\Controllers\Admin;

use Braintree\Transaction;
use App\Sponsorship;

use Braintree;

use DateTime;

use DateInterval;

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
            
            // $musician = Musician::with('sponsorships')->find(Auth::id());

            // $end_date = new DateTime();

            // if($sponsorship->name == 'Oro') {
            //     $end_date->add(new DateInterval('PT'. 24 .'H'));
            // } else if ($sponsorship->name == 'Platino') {
            //     $end_date->add(new DateInterval('PT'. 72 .'H'));
            // } else {
            //     $end_date->add(new DateInterval('PT'. 144 .'H'));
            // }

            // $musician->sponsorships()->attach($sponsorship->id, ["end_date" => $end_date], $musician->id);

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
        // AAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
        // if ($status->success) {
        //     $doctor = User::with('sponsors')
        //         ->find(Auth::id());

        //     $end_date = new DateTime();
        //     $end_date->add(new DateInterval('PT'.$sponsor->duration.'H'));

        //     /* TODO: gestire i pagamenti dopo il primo (estensione del periodo di sponsor)
        //     if ($doctor->sponsors->count() > 0) {
        //         $db_date = $doctor->sponsors->first();
        //         $end_date = $db_date->add(new DateInterval('PT'.$sponsor->duration.'H'));
        //     }
        //     */

        //     $doctor->sponsors()->attach($sponsor->id, ['end_date' => $end_date]);
        // }

        // return response()->json($status);
    // }
    }
}
