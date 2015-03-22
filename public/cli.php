<?php
// Not allow for http request.
if ( 'cli' != php_sapi_name() ) {
    header("HTTP/1.0 404 Not Found");
    exit();
}

// Define it for not auto running. 
// Like testcase, so that we can depand cli argv to choose which controller run it.
define('APPLICATION_NOT_RUN', true);

// Import application and bootstrap.
require 'index.php';

// Init a request for cli mode, Like
//      php ~/application/Cli.php "request_uri=/cli/crontab/sendmailtorepayment"
//          module:cli, controller:crontab, action:sendMailToPayment
//      php ~/application/Cli.php "request_uri=/cli/daemon/backup"
//          module:cli, controller:daemon, action:backup
$request = new \Yaf\Request\Simple();

// route uri => request
\Yaf\Dispatcher::getInstance()->getRouter()->route($request);

// Dispatch this request
\Yaf\Dispatcher::getInstance()->dispatch($request);
?>