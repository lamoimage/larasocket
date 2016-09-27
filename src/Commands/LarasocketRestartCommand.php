<?php

namespace Lamoimage\Larasocket\Commands;

use Illuminate\Console\Command;

class LarasocketRestartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'socket:restart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'restart the socket service.';

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
        $this->call('socket:stop');
        $this->call('socket:start');
    }
}
