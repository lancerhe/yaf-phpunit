<?php
/**
 * 应用核心视图类  \Core\View\Ajax
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-05-24
 */
namespace Core\View;

class Ajax extends \Yaf\View\Simple {

    /**
     * Display ajax response
     * @param  string  $message   Response message.
     * @param  array   $data      Response data.
     * @param  int     $code      Response code code, success: 0, error: exception code.
     * @return string
     */
    public function display( $message, $data = array(), $code = 0 ) {
        $this->assign('data',    $data);
        $this->assign('code',    $code);
        $this->assign('message', $message);
        parent::display( 'response.html' );
    }

    /**
     * 框架错误模板渲染
     * @return string
     */
    public function frameworkExceptionHandler( \Yaf\Exception $exception ) {
        $this->display(null, $exception->getMessage(), $exception->getCode());
    }

    /**
     * 自定义级别异常模板渲染
     * @return string
     */
    public function defaultExceptionHandler( \Exception $exception ) {
        $this->display(null, $exception->getMessage(), $exception->getCode());
    }
}