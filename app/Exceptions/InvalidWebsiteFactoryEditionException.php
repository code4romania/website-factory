<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class InvalidWebsiteFactoryEditionException extends Exception
{
    public function __construct(string $edition, array $allowed = [])
    {
        parent::__construct("Invalid website factory edition `$edition`. Allowed editions: " . implode(', ', $allowed));
    }
}
