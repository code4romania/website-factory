<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class InvalidBlockTypeException extends Exception
{
    public function __construct(string $type)
    {
        parent::__construct("Invalid block type `$type`.");
    }
}
