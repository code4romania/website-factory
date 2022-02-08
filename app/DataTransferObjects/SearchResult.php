<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class SearchResult extends DataTransferObject
{
    public string $type;

    public string $title;

    public string $url_admin;

    public string $url_public;

    public ?string $description = null;

    public ?string $updated_at = null;
}
