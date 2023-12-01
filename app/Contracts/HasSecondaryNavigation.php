<?php

declare(strict_types=1);

namespace App\Contracts;

interface HasSecondaryNavigation
{
    public function getSecondaryNavigation(): array;
}
