<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\InvalidBlockTypeException;
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
            throw new InvalidBlockTypeException($type);
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
            ->map(function (SplFileInfo $file) {
                $component = (string) Str::of($this->filesystem->get($file))
                    ->after('<script>')
                    ->before('</script>');

                $type = $this->getProperty('type', $component) ?? Str::kebab(preg_replace('/(.vue|.js)$/u', '', $file->getFilename()));

                return [
                    'type'    => $type,
                    'icon'    => $this->getProperty('icon', $component) ?? 'Design/layout-top-2-line',
                    'feature' => $this->getProperty('feature', $component),
                    'label'   => __("block.$type"),
                ];
            })
            ->filter(fn (array $block) => \is_null($block['feature']) || Features::enabled($block['feature']))
            ->sortBy('label', \SORT_NATURAL | \SORT_FLAG_CASE)
            ->groupBy('feature')
            ->values();
    }

    private function getProperty(string $name, string $subject, mixed $default = null): ?string
    {
        preg_match("/^\\s+{$name}: '([a-z0-9\/-]+)',$/uim", $subject, $matches);

        return $matches[1] ?? $default;
    }
}
