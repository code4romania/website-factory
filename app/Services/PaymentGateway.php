<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Omnipay;

class PaymentGateway
{
    public static function purchase(string $gateway, array $parameters): ResponseInterface
    {
        return Omnipay::create(static::getDriver($gateway))
            ->initialize(static::getConfig($gateway))
            ->purchase($parameters)
            ->send();
    }

    public static function isActive(?string $alias = null): bool
    {
        if (! Features::hasDonations()) {
            return false;
        }

        if (
            null === static::getDriver($alias) ||
            null === static::getConfig($alias)
        ) {
            return false;
        }

        return true;
    }

    public static function getDriver(string $gateway): ?string
    {
        $class = config("website-factory.payments.gateways.{$gateway}.driver");

        return ! \is_null($class) && class_exists($class) ? $class : null;
    }

    public static function getConfig(string $name): ?array
    {
        return array_merge(
            config('website-factory.payments.defaults', []),
            config("website-factory.payments.gateways.{$name}.config", [])
        );
    }

    public static function setConfig(string $name, string $driver, array $config, bool $recurring = false): void
    {
        Config::set("website-factory.payments.gateways.{$name}", [
            'driver'    => $driver,
            'recurring' => $recurring,
            'config'    => $config,
        ]);
    }
}
