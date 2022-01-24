<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class OneEmailPerLine implements Rule
{
    /**
     * Rules to validate against.
     *
     * @var array
     */
    protected array $rules = [
        'email' => ['required', 'email'],
    ];

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value))
            ->filter()
            ->every(
                fn (string $email) => Validator::make(
                    ['email' => $email],
                    $this->rules
                )->passes()
            );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.email');
    }
}
