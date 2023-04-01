<?php

declare(strict_types=1);

namespace App\Traits;

use App\Services\SupportsTrait;
use Illuminate\Database\Eloquent\Model;

trait Duplicatable
{
    public function duplicate(): Model
    {
        /** @var Model */
        $duplicate = $this->replicate();

        $duplicate->push();

        if (SupportsTrait::blocks($this)) {
            $duplicate->saveBlocks($this->blocks->toArray());
        }

        if (SupportsTrait::media($this)) {
            $duplicate->saveMedia($this->media->toArray());
        }

        return $duplicate;
    }
}
