<?php

return [
    'server' => env('SWOOLE_HOST', '0.0.0.0'),
    'port' => env('SWOOLE_PORT', 9501),
    'mode' => SWOOLE_PROCESS,
    'sock_type' => SWOOLE_SOCK_TCP,
    'swoole_setting' => array(
            'timeout'                  => 0.5,
            'worker_num'               => 8,
            'backlog'                  => 128,
            'open_cpu_affinity'        => 111,
            'open_tcp_nodelay'         => 1,
            'debug_mode'           => 1,
            'log_file'                 => '/tmp/swoole.log',
            'daemonize'                => false,
            'heartbeat_check_interval' => 60,
            'heartbeat_idle_time'      => 86400,
        ),
];
