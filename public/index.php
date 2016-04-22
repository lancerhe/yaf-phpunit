<?php
date_default_timezone_set("Asia/Shanghai");
define('ROOT_PATH',               dirname(dirname(__FILE__)));
define('PUBLIC_PATH',             ROOT_PATH . '/public');
define('VENDOR_PATH',             ROOT_PATH . '/vendor');
define('APPLICATION_PATH',        ROOT_PATH . '/application');
define('APPLICATION_IS_CLI',      (php_sapi_name() == 'cli') ? true : false);
define('APPLICATION_ENVIRON',     defined('YAF_ENVIRON') ? YAF_ENVIRON : \Yaf\ENVIRON );

require_once VENDOR_PATH . "/autoload.php";

$application = new \Yaf\Application( APPLICATION_PATH . "/config/application.ini", APPLICATION_ENVIRON);
$application->bootstrap();

if ( ! defined('APPLICATION_NOT_RUN') ) {
    $application->run();
}