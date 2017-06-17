<?php

namespace Lamoimage\Larasocket\Commands;

use Illuminate\Console\Command;

class LarasocketStartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'socket:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'start the socket service.';

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
        $this->info('starting the socket service....');
        $this->start();
    }

    public function start()
    {
        $this->server = new \swoole_websocket_server(config('larasocket.server'), config('larasocket.port'), config('larasocket.mode'));

        $this->server->set(config('larasocket.swoole_setting'));

        $handle = app('Lamoimage\Larasocket\Socket');

        // $this->server->on('handshake', array($handle, 'handshake'));
        $this->server->on('Open', array($handle, 'onOpen'));
        $this->server->on('Message', array($handle, 'onMessage'));
        $this->server->on('Close', array($handle, 'onClose'));
        $this->server->on('Request', array($handle, 'onRequest'));
        ;

        $this->server->start();
    }
}
