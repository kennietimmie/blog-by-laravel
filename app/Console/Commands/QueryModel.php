<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class QueryModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'model:query
        {model : The model to query, full class path}
        {--view=table : Display list or table, default is table}
        {--select=* : Select specific fields}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Quickly query a model';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $model = $this->argument('model');
        $fields = empty($this->option('select')) ? Schema::getColumnListing((new $model)->getTable()) : $this->option('select');
        return $this->table( $fields,
            collect(($model)::all($fields)->toArray())
        );
    }
}
