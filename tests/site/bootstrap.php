<?php
namespace Tests;

define('APPLICATION_NOT_RUN', true);

/**
 * Class TestCase
 *
 * @package Tests
 * @author  Lancer He <lancer.he@gmail.com>
 */
class TestCase extends \PHPUnit_Framework_TestCase {

    /**
     * @var \Yaf\Application
     */
    protected static $_app;

    /**
     * @var \Yaf\View\Simple
     */
    protected static $_view;

    /**
     * setUp
     */
    public function setUp() {
        if ( ! \Yaf\Registry::get('ApplicationInit') ) {
            $this->__setUpYafApplication();
        } else {
            $this->__setUpApplicationInit();
        }
    }

    /**
     * setup php ini variables
     */
    private function __setUpPHPIniVariables() {

    }

    /**
     * setup yaf application init
     */
    private function __setUpApplicationInit() {
        self::$_app  = \Yaf\Dispatcher::getInstance()->getApplication();
        self::$_view = \YafUnit\View\Simple::getInstance();
    }

    /**
     * setup yaf
     */
    private function __setUpYafApplication() {
        $this->__setUpPHPIniVariables();
        // Import application and bootstrap.
        \Yaf\Loader::import(dirname(dirname(__DIR__)) . '/public/'.basename(dirname(__FILE__)).'/index.php');

        $this->__setUpApplicationInit();

        \Yaf\Dispatcher::getInstance()->registerPlugin( new \YafUnit\Plugin\View );
        \Yaf\Registry::set( 'ApplicationInit', true );
    }

    /**
     * @return \Yaf\Application
     */
    public function getApplication() {
        return self::$_app;
    }

    /**
     * @return \Yaf\View\Simple
     */
    public function getView() {
        return self::$_view;
    }
}

/**
 * Class DbTestCase
 *
 * @package Tests
 * @author  Lancer He <lancer.he@gmail.com>
 */
class DbTestCase extends TestCase {

    /**
     * setup
     */
    public function setUp() {
        parent::setUp();
        if ( ! \Yaf\Registry::get('ApplicationDbInit') ) {
            $this->__setUpDatabase();
        }
    }

    /**
     * setup database connection and create table in memory
     *
     * @throws \ActiveRecord\DatabaseException
     */
    private function __setUpDatabase() {
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

    /**
     * @return \ActiveRecord\Connection
     */
    public function getDatabase() {
        return \ActiveRecord\ConnectionManager::get_connection();
    }

    /**
     * teardown for delete table
     * @throws \ActiveRecord\DatabaseException
     */
    public function tearDown() {
        $tables = $this->getDatabase()->query("SELECT name FROM sqlite_master WHERE type='table';")->fetchAll(\PDO::FETCH_ASSOC);
        foreach($tables as $table) {
            $table = $table['name'];
            if ( false !== strpos($table, 'sqlite_') )
                continue;

            $this->getDatabase()->query("DELETE FROM {$table}");
            $this->getDatabase()->query("DELETE FROM sqlite_sequence WHERE name = '{$table}';");
        }
    }
}