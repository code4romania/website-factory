<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Setting;
use App\Services\Features;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Arr;
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
            'driver'    => '\App\Payments\Euplatesc\Gateway',
            'recurring' => true,
            'config'    => [
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
        $certificate = $this->getCertificatePath('donations.mobilpay_certificate');
        $privateKey = $this->getCertificatePath('donations.mobilpay_private_key');

        if (\is_null($signature) || \is_null($certificate) || \is_null($privateKey)) {
            return;
        }

        data_set($this->settings, 'payments.gateways.mobilpay', [
            'driver'    => '\App\Payments\Mobilpay\Gateway',
            'recurring' => false,
            'config'    => [
                'signature'   => $signature,
                'certificate' => $certificate,
                'privateKey'  => $privateKey,
            ],
        ]);
    }

    private function getCertificatePath(string $key): ?string
    {
        $cachedPath = "private/$key";

        $content = Arr::pull($this->settings, $key);

        if (Storage::disk('local')->exists($cachedPath)) {
            return Storage::disk('local')->path($cachedPath);
        }

        if (\is_null($content)) {
            return null;
        }

        try {
            Storage::disk('local')->put($cachedPath, decrypt($content));

            return Storage::disk('local')->path($cachedPath);
        } catch (DecryptException $e) {
            return null;
        }
    }
}
