<?php
/**
 * 命令行执行PHP 入口
 * @author Lancer He <lancer.he@gmail.com>
 */

set_time_limit(0);
ini_set('memory_limit', '256M');
// define it for not auto running. 
// like testcase, so that we can depand cli argv to choose which controller run it.
define('APPLICATION_NOT_RUN', true);

// Import application and bootstrap.
\Yaf\Loader::import( dirname(__FILE__) . '/../public/index.php' );

// Init a request for cli mode, Like
//      php ./application/Cli.php "request_uri=/cli/crontab/sendmailtorepayment"
//          module:cli, controller:crontab, action:sendMailToPayment
//      php ./application/Cli.php "request_uri=/cli/daemon/backup"
//          module:cli, controller:daemon, action:backup
$request = new \Yaf\Request\Simple();

// route uri => request
\Yaf\Dispatcher::getInstance()->getRouter()->route($request);

// dispatch this request
\Yaf\Dispatcher::getInstance()->dispatch($request);