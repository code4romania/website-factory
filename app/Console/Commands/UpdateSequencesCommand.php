<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use stdClass;

class UpdateSequencesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wf:sequences {--t|table=* : Specific tables to target. If not specified, the command will apply to all tables. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix pgsql primary key sequences';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (DB::connection()->getConfig('driver') !== 'pgsql') {
            $this->error('Current database driver is not pgsql. Can‘t fix sequences.');

            return self::FAILURE;
        }

        $items = $this->getSequences();

        if ($items->isEmpty()) {
            $this->error('Could not find any matching sequences.');

            return self::FAILURE;
        }

        $items = $items->map(function (array $item) {
            $item['value'] = DB::table($item['table'])
                ->selectRaw("SETVAL('{$item['seq']}', COALESCE(MAX({$item['pkey']}), 1)) as seq")
                ->first()
                ->seq;

            return $item;
        });

        $this->info('Successfully updated the following sequences:');

        $this->table(
            ['seq', 'table', 'pkey', 'value'],
            $items
        );

        return self::SUCCESS;
    }

    /**
     * Get all the table-owned sequences and filter them through the command options.
     *
     * @link https://wiki.postgresql.org/wiki/Fixing_Sequences
     *
     * @return Collection
     */
    protected function getSequences(): Collection
    {
        $rows = DB::select(<<<'SQL'
            SELECT
                s.relname AS seq,
                t.relname AS table,
                a.attname AS pkey
            FROM
                pg_class s
                JOIN pg_depend d ON d.objid = s.oid AND d.classid = 'pg_class'::regclass AND d.refclassid = 'pg_class'::regclass
                JOIN pg_class t ON t.oid = d.refobjid
                JOIN pg_namespace n ON n.oid = t.relnamespace
                JOIN pg_attribute a ON a.attrelid = t.oid AND a.attnum = d.refobjsubid
            WHERE
                s.relkind = 'S'
                AND d.deptype = 'a'
            ORDER BY
                s.relname;
        SQL);

        $tables = collect($this->option('table'))
            ->filter();

        return collect($rows)
            ->when(
                $tables->isNotEmpty(),
                fn (Collection $items) => $items->filter(
                    fn (stdClass $item) => $tables->contains($item->table)
                )
            )
            ->map(fn (stdClass $row) => (array) $row);
    }
}
