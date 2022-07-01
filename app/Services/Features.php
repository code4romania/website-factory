<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\InvalidWebsiteFactoryEdition;

class Features
{
    private const DECISIONS = 'decisions';

    private const DONATIONS = 'donations';

    private const THEME = 'theme';

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
                static::THEME,
            ],
            'primarie' => [
                static::DECISIONS,
                static::THEME,
            ],
            'minister' => [
                static::DECISIONS,
            ],
            'develop' => [
                static::DECISIONS,
                static::DONATIONS,
                static::THEME,
            ],
            default => throw new InvalidWebsiteFactoryEdition($edition, ['ong', 'primarie', 'minister']),
        });

        return $edition;
    }

    /**
     * List all the enabled features.
     *
     * @return array
     */
    public static function all(): array
    {
        return config(static::$featureKey, []);
    }

    /**
     * Determine if the given feature is enabled.
     *
     * @param  string $feature
     * @return bool
     */
    public static function enabled(string $feature): bool
    {
        return \in_array($feature, self::all());
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

    /**
     * Determine if the application is using the theme feature.
     *
     * @return bool
     */
    public static function hasTheme(): bool
    {
        return static::enabled(static::THEME);
    }
}
