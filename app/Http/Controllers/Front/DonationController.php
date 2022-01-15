<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\DonationRequest;
use App\Services\PaymentGateway;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function submit(string $locale, DonationRequest $request)
    {
        $attributes = $request->validated();

        \abort_unless(PaymentGateway::isActive($attributes['gateway']), 403);

        $response = PaymentGateway::purchase($attributes['gateway'], [
            'amount'    => $attributes['amount'],
            'currency'  => $attributes['currency'],
            'orderId'   => \time(),
            'orderName' => 'donation',
            'returnUrl' => localized_route('front.donations.return'),
            'notifyUrl' => localized_route('front.donations.webhook'),
            'card'      => [
                'first_name' => $attributes['first_name'],
                'last_name'  => $attributes['last_name'],
                'email'      => $attributes['email'],
                'phone'      => $attributes['phone'],
            ],
            'recurrence' => ['times' => 10, 'interval' => '28'],
        ]);

        if ($response->isSuccessful()) {
            return $response;
        } elseif ($response->isRedirect()) {
            return $response->redirect();
        } else {
            return $response->getMessage();
        }
    }

    public function return(string $locale, Request $request)
    {
        dd($locale, $request);
    }

    public function webhook(string $locale, Request $request)
    {
        dd($locale, $request);
    }
}
