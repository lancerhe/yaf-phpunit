<?php
/**
 * Login Controller Test 
 * 基于Session测试Demo，注：当Session初始化时候会分配一个新的sessid，存放在/tmp/下
 * 每次phpunit测试只会使用一个sesscli文件
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-15
 */
namespace YafUnit\TestCase\Controller;

use YafUnit\TestCase;
use YafUnit\Request\Simple;
use YafUnit\Request\Http;

class LoginTest extends TestCase {

    public function setUp() {
        parent::setUp();
        \Core\Session::getInstance()->clear();
    }

    /**
     * @test
     * 未登陆的Seesion状态 
     */
    public function notLogin() {
        $request = new Http("/login/status");
        \Core\Session::getInstance()->set('login', 0);

        self::$_app->getDispatcher()->dispatch($request);
        $this->assertEquals(0, self::$_view->login);
    }


    /**
     * @test
     * 已经登陆的Seesion状态 
     */
    public function hasLogin() {
        $request = new Http("/login/status");
        \Core\Session::getInstance()->login = 1;

        self::$_app->getDispatcher()->dispatch($request);
        $this->assertEquals(1, self::$_view->login);
    }
}