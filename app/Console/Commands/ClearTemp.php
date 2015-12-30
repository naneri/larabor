<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearTemp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'temp:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears temporary images';

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
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
