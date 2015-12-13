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

class DbTestCase extends TestCase {

    protected static $_database;
    
    public function setUp() {
        parent::setUp();
        if ( ! \Yaf\Registry::get('ApplicationDbInit') ) {
            $this->__setUpDatabase();
        }
    }

    private function __setUpDatabase() {
        \ActiveRecord\Config::instance()->set_connections(['test' => 'sqlite://memory']);
        \ActiveRecord\Config::instance()->set_default_connection("test");

        $tables = $this->getDatabase()->tables();
        foreach($tables as $table) {
            if ('sqlite_sequence' == $table)
                continue;
            $this->getDatabase()->query("DROP TABLE {$table}");
        }
        $sqlcontent = file_get_contents(dirname(__FILE__) . '/acceptance/setup/sqlite.sql');
        foreach(explode(";", $sqlcontent) as $sql) {
            if (trim($sql) == '')
                continue;
            $this->getDatabase()->query(trim($sql));
        }
        \Yaf\Registry::set( 'ApplicationDbInit', true );
    }

    public function getDatabase() {
        return \ActiveRecord\ConnectionManager::get_connection();
    }

    public function tearDown() {
        $tables = $this->getDatabase()->tables();
        foreach($tables as $table) {
            if ( false !== strpos($table, 'sqlite_') )
                continue;
            $this->getDatabase()->query("DELETE FROM {$table}");
            $this->getDatabase()->query("DELETE FROM sqlite_sequence WHERE name = '{$table}';");
        }
    }
}