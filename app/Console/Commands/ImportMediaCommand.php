<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Media;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Plank\Mediable\Commands\ImportMediaCommand as BaseImportCommand;
use Plank\Mediable\Jobs\CreateImageVariants;

class ImportMediaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'media:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a media entity for each file on a disk';

    /**
     * Filesystem used for media storage.
     *
     * @var string
     */
    protected $disk = 'public';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Schema::disableForeignKeyConstraints();

        Media::truncate();

        Schema::enableForeignKeyConstraints();

        collect(Storage::disk($this->disk)->files())
            ->each(function (string $path) {
                $filename = pathinfo($path, \PATHINFO_FILENAME);

                if (Str::endsWith($filename, $this->variants())) {
                    Storage::disk($this->disk)->delete($path);
                }
            });

        $this->call(BaseImportCommand::class, [
            'disk' => $this->disk,
        ]);

        CreateImageVariants::dispatchSync(
            Media::whereAggregateType('image')->whereIsOriginal()->get(),
            $this->variants()
        );

        return Command::SUCCESS;
    }

    protected function variants(): array
    {
        return config('mediable.variants', []);
    }
}
