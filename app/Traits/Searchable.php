<?php

declare(strict_types=1);

namespace App\Traits;

use App\DataTransferObjects\SearchResult;
use App\Services\SupportsTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Searchable
{
    abstract public function getSearchResultAttribute(): SearchResult;

    abstract protected function getSearchableColumns(): array;

    /**
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string                                $terms
     * @param  bool                                  $searchAllLanguages
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch(Builder $query, string $terms, bool $searchAllLanguages = false): Builder
    {
        $terms = (string) Str::of(html_entity_decode($terms))
            ->stripTags();

        $columns = $this->getSearchableColumns();

        return $query
            ->when(
                $searchAllLanguages,
                function (Builder $query) use ($columns, $terms) {
                    locales()->each(
                        function (array $config, string $locale) use ($query, $columns, $terms) {
                            $query->whereFullText(
                                $this->prepareSearchColumns($columns, $locale),
                                $terms,
                                $this->prepareSearchOptions($locale),
                                'or'
                            );

                            if (SupportsTrait::blocks($this)) {
                                $query->orWhereHas('blocks', function (Builder $query) use ($terms, $locale) {
                                    $query->whereFullText(
                                        'blocks.content',
                                        $terms,
                                        $this->prepareSearchOptions($locale)
                                    );
                                });
                            }
                        }
                    );
                },
                function (Builder $query) use ($columns, $terms) {
                    $query->whereFullText(
                        $this->prepareSearchColumns($columns, app()->getLocale()),
                        $terms,
                        $this->prepareSearchOptions()
                    );

                    if (SupportsTrait::blocks($this)) {
                        $query->orWhereHas('blocks', function (Builder $query) use ($terms) {
                            $query->whereFullText(
                                'blocks.content',
                                $terms,
                                $this->prepareSearchOptions()
                            );
                        });
                    }
                }
            )
            ->when(
                SupportsTrait::publishable($this),
                fn (Builder $query) => $query->withDrafted()
            );
    }

    private function prepareSearchColumns(array $columns, ?string $locale = null): array
    {
        $locale ??= app()->getLocale();

        return collect($columns)
            ->map(function (string $column) use ($locale) {
                if (
                    SupportsTrait::translatable($this) &&
                    $this->isTranslatableAttribute($column)
                ) {
                    $column .= '->' . $locale;
                }

                return $column;
            })
            ->toArray();
    }

    private function prepareSearchOptions(?string $locale = null): array
    {
        $connection = config('database.default');

        $driver = config("database.connections.{$connection}.driver");

        if ($driver === 'mysql') {
            return [
                'mode' => 'boolean',
            ];
        }

        if ($driver === 'pgsql') {
            $locale ??= app()->getLocale();

            return [
                'mode' => 'websearch',
                'language' => match ($locale) {
                    'ar' => 'arabic',
                    'hy' => 'armenian',
                    'eu' => 'basque',
                    'ca' => 'catalan',
                    'da' => 'danish',
                    'nl' => 'dutch',
                    'en' => 'english',
                    'fi' => 'finnish',
                    'fr' => 'french',
                    'de' => 'german',
                    'el' => 'greek',
                    'hi' => 'hindi',
                    'hu' => 'hungarian',
                    'id' => 'indonesian',
                    'ga' => 'irish',
                    'it' => 'italian',
                    'lt' => 'lithuanian',
                    'ne' => 'nepali',
                    'no' => 'norwegian',
                    'pt' => 'portuguese',
                    'ro' => 'romanian',
                    'ru' => 'russian',
                    'sr' => 'serbian',
                    'es' => 'spanish',
                    'sv' => 'swedish',
                    'ta' => 'tamil',
                    'tr' => 'turkish',
                    'yi' => 'yiddish',
                    default => 'simple',
                },
            ];
        }

        return [];
    }
}
