<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-01-01
 * Time: 20:06
 */

return [
    'SERVER_NAME'   => "EasySwoole",
    'MAIN_SERVER'   => [
        'LISTEN_ADDRESS' => '0.0.0.0',
        'PORT'           => 9501,
        'SERVER_TYPE'    => EASYSWOOLE_WEB_SERVER, //可选为 EASYSWOOLE_SERVER  EASYSWOOLE_WEB_SERVER EASYSWOOLE_WEB_SOCKET_SERVER
        'SOCK_TYPE'      => SWOOLE_TCP,
        'RUN_MODEL'      => SWOOLE_PROCESS,
        'SETTING'        => [
            'worker_num'            => 8,
            'task_worker_num'       => 8,
            'reload_async'          => true,
            'task_enable_coroutine' => true,
            'max_wait_time'         => 5,
        ],
    ],
    'TEMP_DIR'      => null,
    'LOG_DIR'       => null,
    'CONSOLE'       => [
        'ENABLE'         => true,
        'LISTEN_ADDRESS' => '127.0.0.1',
        'HOST'           => '127.0.0.1',
        'PORT'           => 9500,
        'USER'           => 'root',
        'PASSWORD'       => '123456',
    ],
    'DISPLAY_ERROR' => true,
    'PHAR'          => [
        'EXCLUDE' => ['.idea', 'Log', 'Temp', 'easyswoole', 'easyswoole.install'],
    ],
    /*################ MYSQL CONFIG ##################*/
    'MYSQL'         => [
        'host'          => '127.0.0.1',
        'port'          => '3306',
        'user'          => 'live',
        'timeout'       => '5',
        'charset'       => 'utf8mb4',
        'password'      => 'csm1143669542@',
        'database'      => 'live',
        'POOL_MAX_NUM'  => '20',
        'POOL_TIME_OUT' => '0.1',
        'prefix'        => 'live_',
    ],
];
