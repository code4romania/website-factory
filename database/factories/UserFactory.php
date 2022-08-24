<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\UserRole;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name'              => $this->faker->name(),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
            'role'              => null,
            'locale'            => config('app.locale'),
        ];
    }

    /**
     * Indicate that the users's email address should be unverified.
     *
     * @return \Database\Factories\Factory
     */
    public function unverified(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the user is an administrator.
     *
     * @return \Database\Factories\Factory
     */
    public function admin(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'role' => UserRole::admin->value,
        ]);
    }

    /**
     * Indicate that the user is an editor.
     *
     * @return \Database\Factories\Factory
     */
    public function editor(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'role' => UserRole::editor->value,
        ]);
    }
}
