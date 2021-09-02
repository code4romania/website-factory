<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
            ->count(205)
            ->create();
    }
}
