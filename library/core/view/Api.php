<?php
namespace Core\View;

use Exception;
use StdClass;
use Yaf\Exception as ApplicationException;
use Yaf\View\Simple as Simple;

/**
 * Class Api 应用核心视图类
 *
 * @package Core\View
 * @author  Lancer He <lancer.he@gmail.com>
 */
class Api extends Simple {
    /**
     * @return Api
     */
    public static function create() {
        return new self(APPLICATION_VIEWS_PATH);
    }

    /**
     * @param null   $data    Response data.
     * @param int    $code    Response code code, success: 0, error: exception code.
     * @param string $message Response error message.
     */
    public function response($data = null, $code = 0, $message = '') {
        $this->assign('code', strval($code));
        $this->assign('message', $message);
        $this->assign('data', empty($data) ? new StdClass() : $data);
        $this->assign('time', strval(time()));
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