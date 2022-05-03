<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\InvalidWebsiteFactoryEdition;

class Features
{
    private const DECISIONS = 'decisions';

    private const DONATIONS = 'donations';

    private static string $featureKey = '_website-factory-features';

    /**
     * Configure the website factory edition.
     *
     * @return string
     */
    public static function edition(string $edition): string
    {
        config()->set(static::$featureKey, match ($edition) {
            'ong' => [
                static::DONATIONS,
            ],
            'primarie' => [
                static::DECISIONS,
            ],
            'minister' => [
                static::DECISIONS,
            ],
            'develop' => null,
            default => throw new InvalidWebsiteFactoryEdition($edition, ['ong', 'primarie', 'minister']),
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
        if (config('website-factory.edition') === 'develop') {
            return true;
        }

        return \in_array($feature, config(static::$featureKey, []));
    }

    /**
     * Determine if the application is using the decision feature.
     *
     * @return bool
     */
    public static function hasDecisions(): bool
    {
        return static::enabled(static::DECISIONS);
    }

    /**
     * Determine if the application is using the donation feature.
     *
     * @return bool
     */
    public static function hasDonations(): bool
    {
        return static::enabled(static::DONATIONS);
    }
}
