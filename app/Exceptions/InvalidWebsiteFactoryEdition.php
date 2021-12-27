<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class InvalidWebsiteFactoryEdition extends Exception
{
    public function __construct(string $edition)
    {
        parent::__construct("Invalid website factory edition `$edition`.");
    }
}
