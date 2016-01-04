<?php
namespace Core\View;

use Yaf\View\Simple as Simple;

/**
 * Class Index 应用核心视图类
 *
 * @package Core\View
 * @author  Lancer He <lancer.he@gmail.com>
 */
class Index extends Simple {

    /**
     * @return Api
     */
    public static function create() {
        return new self(APPLICATION_VIEWS_PATH);
    }

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