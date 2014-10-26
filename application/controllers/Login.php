<?php
/**
 * Login Controller
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-23
 */
class Controller_Login extends \Core\Controller {

    public function init() {
        \Yaf\Dispatcher::getInstance()->disableView();
    }

    /**
     * 查看session中是否登陆 
     * @url http://yourdomain/login/status
     */
    public function statusAction() {
        if ( \Core\Session::getInstance()->get('login') ) {
            $this->getView()->assign('login', 1);
        } else {
            $this->getView()->assign('login', 0);
        }
    }

    public function parseAction() {
        echo json_encode(array("value" => 200));
    }
}