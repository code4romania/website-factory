<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\InvalidWebsiteFactoryEditionException;

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
        $edition = match ($edition) {
            'minister' => 'government',
            default => $edition,
        };

        config()->set(static::$featureKey, match ($edition) {
            'internal', 'ong' => [
                static::DONATIONS,
                static::THEME,
            ],
            'primarie' => [
                static::DECISIONS,
                static::THEME,
            ],
            'government' => [
                static::DECISIONS,
            ],
            'develop' => [
                static::DECISIONS,
                static::DONATIONS,
                static::THEME,
            ],
            default => throw new InvalidWebsiteFactoryEditionException($edition, ['ong', 'primarie', 'government']),
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

    /**
     * Determine if the application is running a Code for Romania site.
     *
     * @return bool
     */
    public static function isCode4RomaniaSite(): bool
    {
        return config('website-factory.edition') === 'internal';
    }

    /**
     * Determine if the application is running a government site.
     *
     * @return bool
     */
    public static function isGovernmentSite(): bool
    {
        return config('website-factory.edition') === 'government';
    }
}
