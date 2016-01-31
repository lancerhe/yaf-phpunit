<?php
namespace Core\View;

use Exception;
use Yaf\View\Simple as Simple;
use Yaf\Exception as ApplicationException;

/**
 * Class Main 应用核心视图类
 *
 * @package Core\View
 * @author  Lancer He <lancer.he@gmail.com>
 */
class Main extends Simple {
    /**
     * @return Main
     */
    public static function create() {
        return new self(APPLICATION_VIEWS_PATH);
    }

    /**
     * Display page
     *
     * @param  string $tpl      file_path, ex: production/index.html.
     * @param  array  $tpl_vars display variables.
     * @return string
     */
    public function display($tpl, $tpl_vars = null) {
        header("Content-type: text/html; charset=utf-8");
        parent::display($tpl, $tpl_vars);
    }

    /**
     * @param ApplicationException $exception
     */
    public function frameworkExceptionHandler(ApplicationException $exception) {
        if ( APPLICATION_ENVIRON_PRODUCT ) {
            header("HTTP/1.1 404 Not Found");
            $this->display('error/404.html');
        } else {
            $this->assign('class', get_class($exception));
            $this->assign('message', $exception->getMessage());
            $this->display('error/debug.html');
        }
    }

    /**
     * @param Exception $exception
     */
    public function defaultExceptionHandler(Exception $exception) {
        $this->assign('message', $exception->getMessage());
        $this->display('error/default.html');
    }
}