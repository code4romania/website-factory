<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wf:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin account';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Creating an admin account...');

        $name = $this->getUserName();
        $email = $this->getUserEmail();
        $password = $this->getUserPassword();

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->info('The admin account was successfully created!');

        return self::SUCCESS;
    }

    protected function getUserName(): string
    {
        $name = $this->ask('Full name');

        $validator = $this->validateName($name);

        if (! $validator['valid']) {
            $this->error($validator['error']);

            return $this->getUserName();
        }

        return $name;
    }

    protected function getUserEmail(): string
    {
        $email = $this->ask('Email');

        $validator = $this->validateEmail($email);

        if (! $validator['valid']) {
            $this->error($validator['error']);

            return $this->getUserEmail();
        }

        return $email;
    }

    protected function getUserPassword(): string
    {
        $password = $this->secret('Password');

        $validator = $this->validatePassword($password);

        if (! $validator['valid']) {
            $this->error($validator['error']);

            return $this->getUserPassword();
        }

        $confirmation = $this->secret('Password confirmation');

        $validator = $this->validatePassword($password, $confirmation);

        if (! $validator['valid']) {
            $this->error($validator['error']);

            return $this->getUserPassword();
        }

        return $password;
    }

    private function validateName(?string $name): array
    {
        $validator = Validator::make(
            ['name' => $name],
            ['name' => ['required', 'string', 'max:200']]
        );

        return [
            'valid' => $validator->passes(),
            'error' => $validator->errors()->first('name'),
        ];
    }

    private function validateEmail(?string $email): array
    {
        $validator = Validator::make(
            ['email' => $email],
            ['email' => ['required', 'email', 'max:200', 'unique:users']]
        );

        return [
            'valid' => $validator->passes(),
            'error' => $validator->errors()->first('email'),
        ];
    }

    private function validatePassword(?string $password, ?string $confirmation = null): array
    {
        $validator = Validator::make(
            [
                'password' => $password,
                'password_confirmation' => $confirmation,
            ],
            [
                'password' => [
                    Password::default(),
                    'required',
                    ! \is_null($confirmation) ? 'confirmed' : 'required',
                ],
            ],
        );

        return [
            'valid' => $validator->passes(),
            'error' => $validator->errors()->first('password'),
        ];
    }
}
