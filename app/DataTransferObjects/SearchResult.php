<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Carbon\Carbon;

class SearchResult
{
    public readonly string $type;

    public readonly string $title;

    public readonly string $url_admin;

    public readonly string $url_public;

    public readonly ?string $description;

    public readonly ?string $updated_at;

    public function __construct(
        string $type,
        string $title,
        string $url_admin,
        string $url_public,
        ?string $description = null,
        ?Carbon $updated_at = null,
    ) {
        $this->type = $type;
        $this->title = $title;
        $this->url_admin = $url_admin;
        $this->url_public = $url_public;
        $this->description = strip_tags($description);
        $this->updated_at = $updated_at?->diffForHumans();
    }
}
