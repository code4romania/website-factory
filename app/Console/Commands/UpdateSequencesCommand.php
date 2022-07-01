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
     * @return \Illuminate\Support\Collection
     */
    protected function getSequences(): Collection
    {
        $rows = DB::select(<<<'SQL'
            SELECT
                S.relname as seq,
                T.relname as table,
                pg_attribute.attname as pkey
            FROM
                pg_class AS S,
                pg_class AS T,
                pg_depend,
                pg_attribute,
                pg_tables
            WHERE
                S.relkind = 'S'
                AND S.oid = pg_depend.objid
                AND pg_depend.refobjid = T.oid
                AND pg_depend.refobjid = pg_attribute.attrelid
                AND pg_depend.refobjsubid = pg_attribute.attnum
                AND T.relname = pg_tables.tablename
            ORDER BY
                S.relname;
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
