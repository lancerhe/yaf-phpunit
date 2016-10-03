<?php
use Core\Controller;

/**
 * Class Controller_Login
 *
 * @author Lancer He <lancer.he@gmail.com>
 */
class Controller_Login extends Controller {
    /**
     * init
     */
    public function init() {
        \Yaf\Dispatcher::getInstance()->disableView();
    }

    /**
     * 查看session中是否登陆
     *
     * @url http://yourdomain/login/status
     */
    public function StatusAction() {
        $this->getView()->assign('login', \Core\Session::getInstance()->get('login') ? 1 : 0);
    }

    /**
     * 登陆页 自定义路由
     *
     * @url http://yourdomain/login.html
     */
    public function IndexAction() {
        $this->getView()->assign('pageurl', "http://yourdomain/login.html");
    }
}