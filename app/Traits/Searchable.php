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
     * @param  bool                                  $multilingual
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch(Builder $query, string $terms, bool $multilingual = false): Builder
    {
        $terms = (string) Str::of(html_entity_decode($terms))
            ->stripTags();

        $columns = $this->getSearchableColumns();

        $options = [
            'mode' => 'websearch',
        ];

        return $query
            ->when(
                $multilingual,
                function (Builder $query) use ($columns, $terms, $options) {
                    locales()->each(
                        function (array $config, string $locale) use ($query, $columns, $terms, $options) {
                            $options['language'] = $config['ts_lang'] ?? 'simple';

                            $query->whereFullText(
                                $this->prepareSearchColumns($columns, $locale),
                                $terms,
                                $options,
                                'or'
                            );
                        }
                    );
                },
                function (Builder $query) use ($columns, $terms, $options) {
                    $query->whereFullText(
                        $this->prepareSearchColumns($columns, app()->getLocale()),
                        $terms,
                        $options
                    );
                }
            )
            ->when(
                SupportsTrait::publishable($this),
                fn (Builder $query) => $query->withDrafted()
            )
            ->when(
                SupportsTrait::blocks($this),
                function (Builder $query) use ($terms, $options) {
                    $options['language'] = 'simple';
                    $query->orWhereHas('blocks', fn (Builder $q) => $q->whereFullText('blocks.content', $terms, $options));
                }
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
}
