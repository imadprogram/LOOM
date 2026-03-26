<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;

class BoostController extends Controller
{
    public function checkout($id) {
        $annonce = Annonce::findOrFail($id);

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Boost: ' . $annonce->title,
                    ],
                    'unit_amount' => 1000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/boost/success/' . $annonce->id),
            'cancel_url' => url('/my-listings'),
        ]);

        return redirect($session->url);
    }

    public function success($id) {
        $annonce = Annonce::findOrFail($id);

        $annonce->update([
            'is_boosted' => true,
            'boosted_until' => now()->addDays(7),
        ]);

        return redirect('/my-listings');
    }
}
