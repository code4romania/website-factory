<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Console\Commands\UpdateTranslationsCommand;
use App\Models\Decision;
use App\Models\DecisionCategory;
use App\Models\Form;
use App\Models\Language;
use App\Models\Media;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Person;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use App\Services\Features;
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
        Cache::flush();

        Language::insert([
            [
                'code' => 'ro',
                'name' => 'Română',
                'enabled' => true,
            ],
            [
                'code' => 'en',
                'name' => 'English',
                'enabled' => false,
            ],
        ]);

        Artisan::call(UpdateTranslationsCommand::class);

        $images = Media::query()
            ->whereImages()
            ->whereIsOriginal()
            ->get();

        // Create an admin
        User::factory(['email' => 'admin@example.com'])
            ->admin()
            ->create();

        // Create an editor
        User::factory(['email' => 'editor@example.com'])
            ->editor()
            ->create();

        // Create users with no role
        User::factory()
            ->count(3)
            ->create();

        Page::factory()
            ->count(250)
            ->create();

        PostCategory::factory()
            ->count(10)
            ->has(
                Post::factory()
                    ->count(20)
                    ->afterCreating(function (Post $post) use ($images) {
                        if ($images->isNotEmpty()) {
                            $post->saveMedia([$images->random()]);
                        }
                    })
            )
            ->create();

        Person::factory()
            ->count(50)
            ->create();

        if (Features::hasDecisions()) {
            DecisionCategory::factory()
                ->count(5)
                ->has(
                    Decision::factory()
                        ->count(250)
                )
                ->create();
        }

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
    }
}
