<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Language;
use App\Models\LanguageLine;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    protected array $languages = [
        [
            'code'    => 'ro',
            'name'    => 'Română',
            'enabled' => true,
        ],
        [
            'code'    => 'en',
            'name'    => 'English',
            'enabled' => false,
        ],
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Language::truncate();
        LanguageLine::truncate();

        foreach ($this->languages as $language) {
            Language::create($language);
        }

        LanguageLine::insert(
            collect(app('translation.loader')->load('ro', '*', '*'))
                ->map(fn (string $line, string $key) => [
                    'group' => '*',
                    'key'   => $key,
                    'text'  => json_encode(['ro' => $line]),
                ])
                ->all()
        );
    }
}
