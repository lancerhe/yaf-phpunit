<?php
date_default_timezone_set("Asia/Shanghai");
// Define path.
define('ROOT_PATH',    dirname(dirname(dirname(__FILE__))));
define('PUBLIC_PATH',  ROOT_PATH . '/public');
define('VENDOR_PATH',  ROOT_PATH . '/vendor');
define('LIBRARY_PATH', ROOT_PATH . '/library');
// Define application.
define('APPLICATION_NAME',    basename(dirname(__FILE__)));
define('APPLICATION_PATH',    ROOT_PATH . '/application/' . APPLICATION_NAME);
define('APPLICATION_IS_CLI',  (php_sapi_name() == 'cli') ? true : false);
define('APPLICATION_ENVIRON', defined('YAF_ENVIRON') ? YAF_ENVIRON : \Yaf\ENVIRON);
// Run application.
$application = new \Yaf\Application(APPLICATION_PATH . "/config/application.ini", APPLICATION_ENVIRON);
$application->bootstrap();
! defined('APPLICATION_NOT_RUN') && $application->run();