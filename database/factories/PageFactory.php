<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Page;
use App\Translations\PageTranslation;
use Illuminate\Database\Eloquent\Factories\Sequence;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            // 'title' => $this->translatedFaker('sentence'),
            // 'slug' => $this->translatedFaker('slug'),
        ];
    }

    // /**
    //  * Configure the model factory.
    //  *
    //  * @return $this
    //  */
    // public function configure(): self
    // {
    //     return $this->afterCreating(function (Page $page) {
    //         $locales = collect(config('translatable.locales'));

    //         $page->translations()->saveMany(
    //             PageTranslation::factory()
    //                 ->count($locales->count())
    //                 ->state(new Sequence(
    //                     $locales->mapWithKeys(fn (string $locale) => ['locale' => $locale])
    //                 ))
    //                 ->make()
    //             );
    //     });
    // }
}
