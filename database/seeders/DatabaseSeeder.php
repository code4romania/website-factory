<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Decision;
use App\Models\Form;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Person;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create an admin
        User::factory(['email' => 'admin@example.com'])
            ->admin()
            ->create();

        // Create users with no role
        User::factory()
            ->count(25)
            ->create();

        Page::factory()
            ->count(250)
            ->create();

        Post::factory()
            ->count(250)
            ->create();

        Person::factory()
            ->count(50)
            ->create();

        Decision::factory()
            ->count(250)
            ->create();

        Form::factory()
            ->count(10)
            ->create();

        MenuItem::factory()
            ->header()
            ->external()
            ->count(8)
            ->has(
                MenuItem::factory()
                    ->header()
                    ->external()
                    ->count(4)
                    ->has(
                        MenuItem::factory()
                            ->header()
                            ->external()
                            ->count(5),
                        'children'
                    ),
                'children'
            )
            ->create();

        MenuItem::factory()
            ->footer()
            ->external()
            ->count(4)
            ->has(
                MenuItem::factory()
                    ->footer()
                    ->external()
                    ->count(6),
                'children'
            )
            ->create();

        Artisan::call('media:import');

        Cache::flush();
    }
}
