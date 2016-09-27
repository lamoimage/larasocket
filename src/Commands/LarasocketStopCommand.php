<?php

namespace Lamoimage\Larasocket\Commands;

use Illuminate\Console\Command;

class LarasocketStopCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'socket:stop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'shutdown the socket service.';

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
        $this->info('socket service is shutting down...');
        echo shell_exec('sudo ps -ef | grep \'socket start\'  | grep -v grep | awk \'{ print $2 }\' | sudo xargs kill -9');
    }
}
