<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Page;
use App\Translations\PageTranslation;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locales = collect(config('translatable.locales'))
            ->map(fn (string $locale) => ['locale' => $locale]);

        // dd($locales->all(), $locales->count());

        Page::factory()
            ->count(500)
            ->has(
                PageTranslation::factory()
                    ->count($locales->count())
                    ->sequence(...$locales->all()),
                'translations'
            )
            ->create();
    }
}
