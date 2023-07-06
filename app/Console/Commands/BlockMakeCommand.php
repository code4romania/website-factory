<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class BlockMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:block';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Website Factory block';

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the block'],
        ];
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the block even if it already exists'],
        ];
    }

    protected function getComponentName(bool $kebabCase = false): string
    {
        return Str::of($this->argument('name'))
            ->when(
                $kebabCase,
                fn ($str) => $str->kebab(),
                fn ($str) => $str->studly()
            )
            ->value();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        if ($this->alreadyExists() && ! $this->option('force')) {
            $this->error('Block already exists');

            return self::FAILURE;
        }

        $this->createViewComponent();
        $this->createBladeView();
        $this->createVueComponent();

        return self::SUCCESS;
    }

    protected function alreadyExists(): bool
    {
        return File::exists($this->getViewComponentPath())
            || File::exists($this->getBladeViewPath())
            || File::exists($this->getVueComponentPath());
    }

    protected function getViewComponentPath(): string
    {
        return app_path('View/Components/Blocks/' . $this->getComponentName() . '.php');
    }

    protected function getBladeViewPath(): string
    {
        return resource_path('views/components/blocks/' . $this->getComponentName(kebabCase: true) . '.blade.php');
    }

    protected function getVueComponentPath(): string
    {
        return resource_path('js/components/Blocks/Block/' . $this->getComponentName() . '.vue');
    }

    protected function createViewComponent(): void
    {
        $content = $this->build(
            base_path('stubs/blocks/view-component.stub'),
            [
                'class' => $this->getComponentName(),
            ]
        );

        File::put($this->getViewComponentPath(), $content);
    }

    protected function createBladeView(): void
    {
        File::copy(base_path('stubs/blocks/blade.stub'), $this->getBladeViewPath());
    }

    protected function createVueComponent(): void
    {
        $content = $this->build(
            base_path('stubs/blocks/vue.stub'),
            [
                'name' => $this->getComponentName(kebabCase: true),
            ]
        );

        File::put($this->getVueComponentPath(), $content);
    }

    /**
     * Replace the stub variables(key) with the desire value.
     *
     * @param                    $stub
     * @param  array             $variables
     * @return bool|mixed|string
     */
    protected function build(string $stub, $variables = [])
    {
        return str_replace(
            collect($variables)
                ->keys()
                ->map(fn (string $key) => "{{ $key }}")
                ->all(),
            collect($variables)
                ->values()
                ->all(),
            file_get_contents($stub)
        );
    }
}
