<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\DonationRequest;
use App\Models\Page;
use App\Payments\PaymentGateway;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function submit(string $locale, DonationRequest $request)
    {
        $attributes = $request->validated();

        abort_unless(PaymentGateway::isActive($attributes['gateway']), 403);

        $response = PaymentGateway::purchase($attributes['gateway'], [
            'amount'               => $attributes['amount'] ?? $attributes['other'],
            'currency'             => $attributes['currency'],
            'transactionId'        => (string) time(),
            'transactionReference' => __('donation'),
            'returnUrl'            => localized_route('front.donations.return'),
            'card'                 => [
                'first_name' => $attributes['first_name'],
                'last_name'  => $attributes['last_name'],
                'email'      => $attributes['email'],
                'phone'      => $attributes['phone'],
            ],
            'recurring'  => (bool) $attributes['recurring'],
        ]);

        if ($response->isSuccessful()) {
            return $response;
        } elseif ($response->isRedirect()) {
            return response()->json([
                'redirect' => [
                    'method' => $response->getRedirectMethod(),
                    'url' => $response->getRedirectUrl(),
                    'data' => $response->getRedirectData(),
                ],
            ]);
        } else {
            return $response->getMessage();
        }
    }

    public function return(string $locale, Request $request): RedirectResponse
    {
        $page = Page::findOrFail(settings('donations.page.thanks'));

        return redirect()->to(localized_route('front.pages.show', ['page' => $page]));
    }
}
