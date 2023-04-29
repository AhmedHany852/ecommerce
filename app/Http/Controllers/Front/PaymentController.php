<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function create(Order $order)
    {
        return view('front.payments.create', [
            'order' => $order,
        ]);
    }

    public function createStripePaymentIntent(Order $order)
    {
        $jsonStr = file_get_contents('php://input');
        $jsonObj = json_decode($jsonStr);
        $amount = $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => calculateOrderAmount($jsonObj->items),
            'amount' => $amount,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
            //'description' => 'Payment for Laravel Stripe Integration'
        ]);
        $output = [
            'clientSecret' => $paymentIntent->client_secret,
        ];

        // Do something with the $charge object (e.g. save to database)

        return redirect()->back()->with('success', 'Payment successful!');
    }
}
