<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

class BlockCollection extends Collection
{
    private Filesystem $filesystem;

    public ?string $source;

    public function __construct(string $type = 'block')
    {
        if (! \in_array($type, ['block', 'repeater', 'form'])) {
            throw new Exception('Invalid block type');
        }

        $this->filesystem = app(Filesystem::class);

        parent::__construct(
            $this->getItems($type)
        );
    }

    private function getItems(string $type): ?Collection
    {
        $source = resource_path('js/components/Blocks/' . ucfirst($type));

        if (! $this->filesystem->exists($source)) {
            return null;
        }

        return collect($this->filesystem->files($source))
            ->filter(function (SplFileInfo $file) {
                $name = Str::kebab(preg_replace('/(.vue|.js)$/u', '', $file->getFilename()));

                if (! Features::hasDonations()) {
                    return ! Str::startsWith($name, 'donation-');
                }

                return true;
            })
            ->map(function (SplFileInfo $file) {
                $component = (string) Str::of($this->filesystem->get($file))
                    ->after('<script>')
                    ->before('</script>');

                return [
                    'icon' => $this->getProperty('icon', $component) ?? 'Design/layout-top-2-line',
                    'type' => $this->getProperty('type', $component) ?? Str::kebab(preg_replace('/(.vue|.js)$/u', '', $file->getFilename())),
                ];
            })
            ->values();
    }

    private function getProperty(string $name, string $subject, mixed $default = null): ?string
    {
        preg_match("/^\\s+{$name}: '([a-z0-9\/-]+)',$/uim", $subject, $matches);

        return $matches[1] ?? $default;
    }
}
