<?php

declare(strict_types=1);

namespace Tests;

use App\Console\Commands\UpdateTranslationsCommand;
use App\Models\Language;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use LazilyRefreshDatabase;
    use WithFaker;

    /**
     * @before
     */
    public function boot(): void
    {
        $this->afterApplicationCreated(function () {
            $this->withoutVite();

            Language::insert([
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
            ]);

            $this->artisan(UpdateTranslationsCommand::class, ['--force' => true]);
        });
    }
}
