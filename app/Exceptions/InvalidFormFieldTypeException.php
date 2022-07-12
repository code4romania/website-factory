<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class InvalidFormFieldTypeException extends Exception
{
    public function __construct(string $type)
    {
        parent::__construct("Invalid form field type `$type`.");
    }
}
