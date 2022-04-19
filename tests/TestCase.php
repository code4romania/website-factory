<?php

declare(strict_types=1);

namespace Tests;

use Database\Seeders\LanguageSeeder;
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
            $this->seed([
                LanguageSeeder::class,
            ]);
        });
    }
}
