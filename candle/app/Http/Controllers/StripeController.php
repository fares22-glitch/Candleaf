<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{

    public function create()
    {
        return view('components.Payment');
    }

    public function store(Request $request)
    {

//        Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
        $customer = $stripe->customers->create([
            'description' => 'example customer',
            'email' => 'email@example.com',
            'payment_method' => 'pm_card_visa',
        ]);
        $customer;

        Stripe\Stripe::charges()->create([
            'amount' => session('after_method'),
            'currency' => "usd",
            'source' => $request->stripeToken,
            'description' => 'Test payment from muhammed essa'
        ]);
        return redirect()->route('message.show');
//        Session::flash('success','Payment has been successfully');
//        return back();
    }


}
