<?php
use ActiveRecord\Config as ActiveRecordConfig;
use Core\ExceptionHandler;
use Yaf\Bootstrap_Abstract as Bootstrap_Abstract;
use Yaf\Config\Ini as ConfigIni;
use Yaf\Dispatcher as Dispatcher;
use Yaf\Loader as Loader;

/**
 * Bootstrap类中, 以_init开头的方法, 都会按顺序执行
 *
 * @author Lancer He <lancer.he@gmail.com>
 * @see    http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 */
class Bootstrap extends Bootstrap_Abstract {
    /**
     * @param Dispatcher $dispatcher
     */
    public function _initConst(Dispatcher $dispatcher) {
        define('APPLICATION_VIEWS_PATH', APPLICATION_PATH . '/views');
        define('APPLICATION_CONFIG_PATH', APPLICATION_PATH . '/config');
        define('APPLICATION_ENVIRON_LOCAL', APPLICATION_ENVIRON === 'local');
        define('APPLICATION_ENVIRON_TEST', APPLICATION_ENVIRON === 'test');
        define('APPLICATION_ENVIRON_PRODUCT', APPLICATION_ENVIRON === 'product');
    }

    /**
     * @param Dispatcher $dispatcher
     */
    public function _initAutoload(Dispatcher $dispatcher) {
        Loader::getInstance()->import(VENDOR_PATH . "/autoload.php");
    }

    /**
     * @param Dispatcher $dispatcher
     */
    public function _initDatabase(Dispatcher $dispatcher) {
        $config = new ConfigIni(APPLICATION_CONFIG_PATH . '/database.ini', APPLICATION_ENVIRON);
        ActiveRecordConfig::instance()->set_connections($config->get('database')->toArray());
        ActiveRecordConfig::instance()->set_default_connection("master");
    }

    /**
     * 抛出异常，不使用\Yaf\ErrorController接收，通过\Core\ExceptionHandler处理
     *
     * @param Dispatcher $dispatcher
     */
    public function _initException(Dispatcher $dispatcher) {
        $dispatcher->throwException(true);
        $dispatcher->catchException(false);
        new ExceptionHandler();
    }

    /**
     * @param Dispatcher $dispatcher
     */
    public function _initLibrary(Dispatcher $dispatcher) {
        $namespace = $dispatcher->getApplication()->getConfig()->get('application.library.local_namespace');
        $namespace = explode(',', $namespace);
        Loader::getInstance()->registerLocalNamespace($namespace);
    }

    /**
     * @param Dispatcher $dispatcher
     */
    public function _initPlugin(Dispatcher $dispatcher) {
    }

    /**
     * @param Dispatcher $dispatcher
     */
    public function _initRoute(Dispatcher $dispatcher) {
        $config = new ConfigIni(APPLICATION_CONFIG_PATH . "/routes.ini");
        $dispatcher->getRouter()->addConfig($config->get('routes'));
    }
}
