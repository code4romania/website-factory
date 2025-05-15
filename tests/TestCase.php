<?php

declare(strict_types=1);

namespace Tests;

use App\Console\Commands\UpdateTranslationsCommand;
use App\Models\Language;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Before;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use LazilyRefreshDatabase;
    use WithFaker;

    #[Before]
    public function boot(): void
    {
        $this->afterApplicationCreated(function () {
            Language::insert([
                [
                    'code' => 'ro',
                    'enabled' => true,
                ],
                [
                    'code' => 'en',
                    'enabled' => false,
                ],
            ]);

            $this->artisan(UpdateTranslationsCommand::class, ['--force' => true]);
        });
    }
}
