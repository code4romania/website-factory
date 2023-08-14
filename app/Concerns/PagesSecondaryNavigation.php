<?php

declare(strict_types=1);

namespace App\Concerns;

trait PagesSecondaryNavigation
{
    public function getSecondaryNavigation(): array
    {
        return [
            [
                'label' => 'page.subnav.pages',
                'route' => 'admin.pages.index',
            ],
            [
                'label' => 'page.subnav.groups',
                'route' => 'admin.page_groups.index',
            ],
        ];
    }
}
