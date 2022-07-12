<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class MethodNotDefinedException extends Exception
{
    public function __construct(string $property, object $class)
    {
        parent::__construct("Method `$property` not defined on " . \get_class($class));
    }
}
