<?php

declare(strict_types=1);

namespace App\View\Components\Blocks;

use App\Models\Block;
use App\Services\Time;
use Embed\Embed;
use Embed\EmbedCode;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class OEmbed extends Component
{
    protected ?EmbedCode $code;

    protected ?string $url;

    public ?string $title = null;

    public ?string $aspectRatio = null;

    public ?string $html = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Block $block)
    {
        $this->title = $block->translatedInput('title');

        $this->url = $block->input('url');

        if (! $this->url) {
            return;
        }

        $this->code = $this->getEmbedCode();

        $this->html = optional($this->code)->html;

        $this->aspectRatio = $this->getAspectRatio();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.o-embed');
    }

    private function getAspectRatio(): ?string
    {
        if (! $this->code || ! $this->code->width || ! $this->code->height) {
            return null;
        }

        $ratioMap = [
            'aspect-w-1 aspect-h-1' => 1 / 1,
            'aspect-w-5 aspect-h-4' => 5 / 4,
            'aspect-w-4 aspect-h-3' => 4 / 3,
            'aspect-w-3 aspect-h-2' => 3 / 2,
            'aspect-w-5 aspect-h-3' => 5 / 3,
            'aspect-w-16 aspect-h-9' => 16 / 9,
            'aspect-w-2 aspect-h-1' => 2 / 1,
            'aspect-w-3 aspect-h-1' => 3 / 1,
            'aspect-w-5 aspect-h-6' => 5 / 6,
            'aspect-w-4 aspect-h-5' => 4 / 5,
            'aspect-w-3 aspect-h-4' => 3 / 4,
            'aspect-w-2 aspect-h-3' => 2 / 3,
            'aspect-w-3 aspect-h-5' => 3 / 5,
            'aspect-w-9 aspect-h-16' => 9 / 16,
            'aspect-w-1 aspect-h-2' => 1 / 2,
            'aspect-w-1 aspect-h-3' => 1 / 3,
        ];

        $search = round($this->code->width / $this->code->height, 3);
        $closest = $ratio = null;

        foreach ($ratioMap as $name => $value) {
            if (is_null($closest) || abs($search - $closest) > abs($value - $search)) {
                $ratio = $name;
                $closest = $value;
            }
        }

        return $ratio;
    }

    private function getEmbedCode(): ?EmbedCode
    {
        return Cache::remember(
            'block-embed-' . \hash('sha256', $this->url),
            config('blocks.cache_ttl', Time::MONTH_IN_SECONDS),
            function () {
                try {
                    $request = (new Embed())->get($this->url);

                    return $request->code;
                } catch (\Throwable $th) {
                    return null;
                }
            }
        );
    }
}
