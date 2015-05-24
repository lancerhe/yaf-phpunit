<?php
/**
 * 应用核心视图类  \Core\View\Index
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-05-24
 */
namespace Core\View;

class Index extends \Yaf\View\Simple {

    /**
     * Display page
     * @param  string  $view_path  filepath, ex: production/index.html.
     * @param  array   $tpl_vars   display variables.
     * @return string
     */
    public function display( $view_path, $tpl_vars = null) {
        header("Content-type: text/html; charset=utf-8");
        parent::display( $view_path, $tpl_vars );
    }

    /**
     * 框架错误模板渲染
     * @return string
     */
    public function frameworkExceptionHandler( \Yaf\Exception $exception ) {
        $this->assign('exception', $exception);
        $this->display('error/error_yaf.html');
    }

    /**
     * 自定义级别异常模板渲染
     * @return string
     */
    public function defaultExceptionHandler( \Exception $exception ) {
        $this->assign('exception', $exception);
        $this->display('error/error.html');
    }
}