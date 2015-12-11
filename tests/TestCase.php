<?php
namespace Tests;

define('APPLICATION_NOT_RUN', true);

class TestCase extends \PHPUnit_Framework_TestCase {

    protected static $_app;

    protected static $_view;

    public function setUp() {
        if ( ! \Yaf\Registry::get('ApplicationInit') ) {
            $this->__setUpYafApplication();
        } else {
            $this->__setUpApplicationInit();
        }
    }

    private function __setUpPHPIniVariables() {

    }

    private function __setUpAutoload() {
        spl_autoload_register(function ($class_name) {
            if ( strpos($class_name, 'Controller_') !== false && ! class_exists( $class_name ) )
                require APPLICATION_CONTROLLERS_PATH . '/' . str_replace("Controller_", '', $class_name) . '.php';
        });
    }

    private function __setUpApplicationInit() {
        self::$_app  = \Yaf\Dispatcher::getInstance()->getApplication();
        self::$_view = \YafUnit\View\Simple::getInstance();
    }

    private function __setUpYafApplication() {
        $this->__setUpPHPIniVariables();
        // Import application and bootstrap.
        \Yaf\Loader::import( dirname(__DIR__) . '/public/index.php' );

        $this->__setUpApplicationInit();

        $this->__setUpAutoload();
        \Yaf\Dispatcher::getInstance()->registerPlugin( new \YafUnit\Plugin\View );
        \Yaf\Registry::set( 'ApplicationInit', true );
    }
}

namespace Tests\TestCase;

use Tests\TestCase;

class Controller extends TestCase {

    public function setUp() {
        parent::setUp();
    }
}