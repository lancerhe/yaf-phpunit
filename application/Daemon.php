<?php
/**
 * Daemon 守护进程 依赖swoole扩展
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-05-19
 */

define('PHP_COMMAND', '/usr/local/php-5.4.33/bin/php');
define('CLI_FILE',    __DIR__ . '/Cli.php');

swoole_timer_add(2000, function($interval) {
    $process = new swoole_process( function(swoole_process $worker) {
        $worker->exec(PHP_COMMAND, array(CLI_FILE, "request_uri=/cli/daemon/pushmessage"));
    }, true);
    $pid = $process->start();
    swoole_process::wait();
});