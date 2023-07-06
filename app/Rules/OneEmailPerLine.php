<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class OneEmailPerLine implements ValidationRule
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
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $valid = collect(preg_split('/\r\n|\r|\n/', (string) $value))
            ->filter()
            ->every(
                fn (string $email) => Validator::make(
                    ['email' => $email],
                    $this->rules
                )->passes()
            );

        if (! $valid) {
            $fail(__('validation.email'));
        }
    }
}
