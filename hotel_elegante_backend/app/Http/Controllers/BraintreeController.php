<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway;

class BraintreeController extends Controller
{
    public function __construct(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function getToken()
    {
        $clientToken = $this->gateway->clientToken()->generate();
        return response()->json(['token' => $clientToken]);
    }

    public function makePayment(Request $request)
    {
        $nonce = $request->input('nonce');
        $amount = $request->input('amount');  // Puoi ottenere l'importo come preferisci

        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            return response()->json(['success' => true, 'message' => 'Payment success!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Payment failed.']);
        }
    }

}
