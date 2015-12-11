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

    private function __setUpApplicationInit() {
        self::$_app  = \Yaf\Dispatcher::getInstance()->getApplication();
        self::$_view = \YafUnit\View\Simple::getInstance();
    }

    private function __setUpYafApplication() {
        $this->__setUpPHPIniVariables();
        // Import application and bootstrap.
        \Yaf\Loader::import( dirname(__DIR__) . '/public/index.php' );

        $this->__setUpApplicationInit();

        \Yaf\Dispatcher::getInstance()->registerPlugin( new \YafUnit\Plugin\View );
        \Yaf\Registry::set( 'ApplicationInit', true );
    }

    public function getApplication() {
        return self::$_app;
    }

    public function getView() {
        return self::$_view;
    }
}