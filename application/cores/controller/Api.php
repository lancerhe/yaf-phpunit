<?php
/**
 * 应用核心控制器类  \Core\Controller\Api
 * Api接口端请求控制器基类
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-06-02
 */
namespace Core\Controller;

class Api extends \Core\Controller {

    /**
     * default exception handler
     * @param  Exception  $exception
     * @param  Core_View  $view
     */
    public static function defaultExceptionHandler( $exception, $view ) {
        $view->displayApi(array(), $exception->getCode());
    }
}