<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class LanguageNotInISO639 extends Exception
{
    public function __construct(string $code)
    {
        parent::__construct("Language code `$code` not found in ISO 639-1.");
    }
}
