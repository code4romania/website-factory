<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Setting;
use App\Services\Features;
use App\Services\PaymentGateway;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Throwable;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            if (! Schema::hasTable('settings')) {
                return;
            }

            Config::set(
                'website-factory.settings',
                Setting::all()
                    ->groupBy('section')
                    ->map
                    ->pluck('value', 'key')
                    ->toArray()
            );

            $this->configurePaymentGateways();
        } catch (Throwable $th) {
            \logger('Could not open connection to database server. Skipping loading site settings...', [
                'error' => $th->getMessage(),
            ]);
        }
    }

    protected function configurePaymentGateways(): void
    {
        Config::set('website-factory.payments.defaults.testMode', ! app()->isProduction());

        if (! Features::hasDonations()) {
            return;
        }

        $this->configureEuplatesc();
        $this->configureMobilpay();
    }

    protected function configureEuplatesc(): void
    {
        if (! settings('donations.euplatesc_enabled')) {
            return;
        }

        $mid = settings('donations.euplatesc_mid');
        $key = settings('donations.euplatesc_key');

        if (\is_null($mid) || \is_null($key)) {
            return;
        }

        PaymentGateway::setConfig(
            name: 'euplatesc',
            driver: '\Paytic\Omnipay\Euplatesc\Gateway',
            recurring: true,
            config: [
                'mid' => $mid,
                'key' => $key,
            ]
        );
    }

    protected function configureMobilpay(): void
    {
        if (! settings('donations.mobilpay_enabled')) {
            return;
        }

        $signature = settings('donations.mobilpay_signature');
        $certificate = settings('donations.mobilpay_certificate');
        $privateKey = settings('donations.mobilpay_private_key');

        if (\is_null($signature) || \is_null($certificate) || \is_null($privateKey)) {
            return;
        }

        if (! Storage::exists($certificate) || ! Storage::exists($privateKey)) {
            return;
        }

        PaymentGateway::setConfig(
            name: 'mobilpay',
            driver: '\Paytic\Omnipay\Mobilpay\Gateway',
            recurring: false,
            config: [
                'signature'   => $signature,
                'certificate' => Storage::path($certificate),
                'privateKey'  => Storage::path($privateKey),
            ]
        );
    }
}
