<?php
namespace Core\View;

use Exception;
use StdClass;
use Yaf\Exception as ApplicationException;
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
        return new self(APPLICATION_VIEWS_PATH);
    }

    /**
     * @param  string $message Response message.
     * @param  array  $data    Response data.
     * @param  int    $code    Response code code, success: 0, error: exception code.
     * @return string
     */
    public function response($message, $data = null, $code = 0) {
        $this->assign('code', intval($code));
        $this->assign('message', $message);
        $this->assign('data', empty($data) ? new StdClass() : $data);
        $this->display();
    }

    /**
     * Display page
     *
     * @param  string $tpl      file_path, ex: production/index.html.
     * @param  array  $tpl_vars display variables.
     * @return string
     */
    public function display($tpl = '', $tpl_vars = null) {
        header('Content-type: application/json');
        exit(json_encode($this->_tpl_vars));
    }

    /**
     * @param ApplicationException $exception
     */
    public function frameworkExceptionHandler(ApplicationException $exception) {
        APPLICATION_ENVIRON_PRODUCT ?
            $this->response("", null, 404) :
            $this->response($exception->getMessage(), null, $exception->getCode());
    }

    /**
     * @param Exception $exception
     */
    public function defaultExceptionHandler(Exception $exception) {
        $this->response($exception->getMessage(), null, $exception->getCode());
    }
}
