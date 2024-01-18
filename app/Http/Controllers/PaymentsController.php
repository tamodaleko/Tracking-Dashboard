<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payment\SaveCreditCardRequest;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function setup(Request $request)
    {
        $intent = $request->user()->company->createSetupIntent();

        return response()->json([
            'client_secret' => $intent ? $intent->client_secret : ''
        ]);
    }

    public function creditCard(SaveCreditCardRequest $request)
    {
        $stripeCustomer = $request->user()->company->createAsStripeCustomer();
        
        if (true) {
            return redirect()->back()
                ->withSuccess('Payment method has been saved successfully.');
        }

        return redirect()->back()
                ->withError('Payment method couldn\'t be saved. Please try again.');
    }
}
