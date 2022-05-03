<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Setting;
use App\Services\Features;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    protected array $settings = [];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('settings', function () {
            $this->settings = Setting::all()
                ->groupBy('section')
                ->map
                ->pluck('value', 'key')
                ->toArray();

            if (Features::hasDonations()) {
                data_set($this->settings, 'payments.defaults.testMode', ! app()->isProduction());

                $this->configureGatewayEuplatesc();
                $this->configureGatewayMobilpay();
            }

            return $this->settings;
        });
    }

    protected function configureGatewayEuplatesc(): void
    {
        if (! data_get($this->settings, 'donations.euplatesc_enabled')) {
            return;
        }

        $mid = data_get($this->settings, 'donations.euplatesc_mid');
        $key = data_get($this->settings, 'donations.euplatesc_key');

        if (\is_null($mid) || \is_null($key)) {
            return;
        }

        data_set($this->settings, 'payments.gateways.euplatesc', [
            'driver'=> '\Paytic\Omnipay\Euplatesc\Gateway',
            'recurring'=> true,
            'config'=> [
                'mid' => $mid,
                'key' => $key,
            ],
        ]);
    }

    protected function configureGatewayMobilpay(): void
    {
        if (! data_get($this->settings, 'donations.mobilpay_enabled')) {
            return;
        }

        $signature = data_get($this->settings, 'donations.mobilpay_signature');
        $certificate = data_get($this->settings, 'donations.mobilpay_certificate');
        $privateKey = data_get($this->settings, 'donations.mobilpay_private_key');

        if (\is_null($signature) || \is_null($certificate) || \is_null($privateKey)) {
            return;
        }

        if (! Storage::exists($certificate) || ! Storage::exists($privateKey)) {
            return;
        }

        data_set($this->settings, 'payments.gateways.mobilpay', [
            'driver' => '\Paytic\Omnipay\Mobilpay\Gateway',
            'recurring' => false,
            'config' => [
                'signature'   => $signature,
                'certificate' => Storage::path($certificate),
                'privateKey'  => Storage::path($privateKey),
            ],
        ]);
    }
}
