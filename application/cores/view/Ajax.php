<?php
namespace Core\View;

use StdClass;
use Yaf\View\Simple as Simple;

/**
 * Class Ajax 应用核心视图类
 *
 * @package Core\View
 * @author  Lancer He <lancer.he@gmail.com>
 */
class Ajax extends Simple {

    /**
     * @return Ajax
     */
    public static function create() {
        return new self(APPLICATION_MODULES_PATH . "/Ajax/views");
    }

    /**
     * response
     * @param  string  $message   Response message.
     * @param  array   $data      Response data.
     * @param  int     $code      Response code code, success: 0, error: exception code.
     * @return string
     */
    public function response( $message, $data = null, $code = 0 ) {
        $this->assign('message', $message);
        $this->assign('data',    empty($data) ? new StdClass() : $data);
        $this->assign('code',    intval($code));
        $this->display();
    }

    /**
     * Display page
     * @param  string  $view_path  filepath, ex: production/index.html.
     * @param  array   $tpl_vars   display variables.
     * @return string
     */
    public function display( $view_path = '', $tpl_vars = null) {
        header('Content-type: application/json');
        parent::display( 'response.html' );
    }

    /**
     * 框架错误模板渲染
     * @return string
     */
    public function frameworkExceptionHandler( \Yaf\Exception $exception ) {
        $this->response($exception->getMessage(), null, $exception->getCode());
    }

    /**
     * 自定义级别异常模板渲染
     * @return string
     */
    public function defaultExceptionHandler( \Exception $exception ) {
        $this->response($exception->getMessage(), null, $exception->getCode());
    }
}
