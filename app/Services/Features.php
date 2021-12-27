<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\InvalidWebsiteFactoryEdition;

class Features
{
    private const FEATURES_CONFIG_KEY = '_website_factory_features';

    /**
     * Configure the website factory edition.
     *
     * @return string
     */
    public static function edition(string $edition): string
    {
        config()->set(static::FEATURES_CONFIG_KEY, match ($edition) {
            'ong' => [
                static::donations(),
            ],
            'primarie' => [
                static::decisions(),
            ],
            'minister' => [
                static::decisions(),
            ],
            'develop' => [
                static::donations(),
                static::decisions(),
            ],
            default => throw new InvalidWebsiteFactoryEdition($edition),
        });

        return $edition;
    }

    /**
     * Determine if the given feature is enabled.
     *
     * @param  string $feature
     * @return bool
     */
    public static function enabled(string $feature): bool
    {
        return \in_array($feature, config(static::FEATURES_CONFIG_KEY, []));
    }

    /**
     * Determine if the application is using the decision feature.
     *
     * @return bool
     */
    public static function hasDecisions(): bool
    {
        return static::enabled(static::decisions());
    }

    /**
     * Determine if the application is using the donation feature.
     *
     * @return bool
     */
    public static function hasDonations(): bool
    {
        return static::enabled(static::donations());
    }

    /**
     *  Enable the decision feature.
     *
     * @return string
     */
    private static function decisions(): string
    {
        return 'decisions';
    }

    /**
     *  Enable the donation feature.
     *
     * @return string
     */
    private static function donations(): string
    {
        return 'donations';
    }
}
