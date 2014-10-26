<?php
/**
 * 应用核心控制器类  \Core\Controller\Cli 
 * 命令行下请求的控制器
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-07-14
 */
namespace Core\Controller;

class Cli extends \Core\Controller {

    /**
     * Only request by cli mode.
     */
    public function init() {
        parent::init();
        if ( ! APP_IS_CLI ) {
            throw new Core_Exception_RequestMethodException();
        } 
    }


    /**
     * default exception handler
     * @param  Exception  $exception
     * @param  Core_View  $view
     */
    public static function defaultExceptionHandler( $exception, $view ) {
        $view->failure($exception->getMessage());
    }
}
