<?php
/**
 * Bootstrap类中, 以_init开头的方法, 都会按顺序执行
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-15
 * @see    http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 */
class Bootstrap extends \Yaf\Bootstrap_Abstract{

    /**
     * Initialize const.
     * @param  \Yaf\Dispatcher $dispatcher
     * @return void
     */
    public function _initConst( \Yaf\Dispatcher $dispatcher ) {
        define('APPLICATION_VIEWS_PATH',    APPLICATION_PATH . '/views');
        define('APPLICATION_CONFIG_PATH',   APPLICATION_PATH . '/config');
        define('APPLICATION_CORES_PATH',    APPLICATION_PATH . '/cores');
        define('APPLICATION_SERVICES_PATH', APPLICATION_PATH . '/services');
        define('APPLICATION_LIBRARY_PATH',  APPLICATION_PATH . '/library');
        define('APPLICATION_MODULES_PATH',  APPLICATION_PATH . '/modules');
    }


    /**
     * Initialize config.
     * @param  \Yaf\Dispatcher $dispatcher
     * @return void
     */
    public function _initConfig( \Yaf\Dispatcher $dispatcher ) {
        $config = $dispatcher->getApplication()->getConfig();
        // save config to dispatcher
        $dispatcher->config = new \Yaf\Config\Simple(array(), false);
        $dispatcher->config->application = $config->application;
    }


    /**
     * Initialize autoload library, like Core_Controller, Http_Request_Curl.
     * @param  \Yaf\Dispatcher $dispatcher
     * @return void
     */
    public function _initAutoload( \Yaf\Dispatcher $dispatcher) {
        \Yaf\Loader::getInstance()->import(APPLICATION_CORES_PATH . '/ClassLoader.php');

        $autoload = new \Core\ClassLoader();
        $autoload->addClassMap(array(
            'Service' => APPLICATION_SERVICES_PATH,
            'Core'    => APPLICATION_CORES_PATH,
        ));
        spl_autoload_register(array($autoload, 'loader'));
        $dispatcher->autoload = $autoload;
    }


    /**
     * Initialize custom exception handler.
     * @param  \Yaf\Dispatcher $dispatcher
     * @return void
     */
    public function _initException( \Yaf\Dispatcher $dispatcher ) {
        // 抛出异常，不使用\Yaf\ErrorController接收，通过\Core\ExceptionHandler处理
        \Yaf\Dispatcher::getInstance()->throwException(true);
        \Yaf\Dispatcher::getInstance()->catchException(false);
        new \Core\ExceptionHandler();
    }


    /**
     * Initialize locate library.
     * @param \Yaf\Dispatcher $dispatcher
     * @return void
     */
    public function _initLibrary( \Yaf\Dispatcher $dispatcher ) {
        //注册本地类前缀
        $namespace = $dispatcher->config->application->library->localnamespace;
        $namespace = explode(',', $namespace);
        \Yaf\Loader::getInstance()->registerLocalNamespace( $namespace );
    }


    /**
     * Initialize plugin.
     * @param \Yaf\Dispatcher $dispatcher
     * @return void
     */
    public function _initPlugin( \Yaf\Dispatcher $dispatcher ) {
        $dispatcher->registerPlugin( new Plugin_View );
    }


    /**
     * Initialize router.
     * @param \Yaf\Dispatcher $dispatcher
     * @return void
     */
    public function _initRoute( \Yaf\Dispatcher $dispatcher ) {
        //注册路由
        $config = new \Yaf\Config\Ini( APPLICATION_CONFIG_PATH . "/routes.ini" );
        if ( empty($config->routes) )
            return ;
        
        $dispatcher->config->routes = $config->routes;
        $dispatcher->getRouter()->addConfig($config->routes);
    }
}
