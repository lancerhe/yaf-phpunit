<?php
/**
 * 应用核心视图类  \Core\View
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-17
 */
namespace Core;

class View extends \Yaf\View\Simple {
    
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
     * Display api response
     * @param  array  $data  Response data.
     * @param  int    $code  Response code code, success: 0, error: exception code.
     * @return string
     */
    public function displayApi( $data = array(), $code = 0 ) {
        $this->assign('data', $data);
        $this->assign('code', $code);
        $this->display(APPLICATION_VIEWS_PATH.'/common/response_api.html');
    }


    /**
     * Display ajax response
     * @param  string  $message   Response message.
     * @param  array   $data      Response data.
     * @param  int     $code      Response code code, success: 0, error: exception code.
     * @return string
     */
    public function displayAjax( $message, $data = array(), $code = 0 ) {
        $this->assign('data',    $data);
        $this->assign('code',    $code);
        $this->assign('message', $message);
        $this->display(APPLICATION_VIEWS_PATH.'/common/response_ajax.html');
    }
}