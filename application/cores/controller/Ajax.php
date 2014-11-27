<?php
/**
 * 应用核心控制器类  \Core\Controller\Ajax 
 * Ajax请求控制器基类
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-05-27
 */
namespace Core\Controller;

class Ajax extends \Core\Controller {

    /**
     * default exception handler
     * @param  Exception  $exception
     * @param  Core_View  $view
     */
    public static function defaultExceptionHandler( $exception, $view ) {
        $view->displayAjax($exception->getMessage(), array(), $exception->getCode());
    }
}