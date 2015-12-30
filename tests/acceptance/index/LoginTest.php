<?php
namespace Tests\Acceptance\Index;

use Tests\TestCase;
use YafUnit\Request\Simple;
use YafUnit\Request\Http;

/**
 * Class LoginTest
 *
 * @package Tests\TestCase\Acceptance\Index
 * @author  Lancer He <lancer.he@gmail.com>
 */
class LoginTest extends TestCase {

    public function setUp() {
        parent::setUp();
        \Core\Session::getInstance()->clear();
    }

    /**
     * @test
     * 未登陆的Seesion状态 
     */
    public function user_not_login() {
        $request = new Simple('Get', 'Index', 'Login', 'Status');
        \Core\Session::getInstance()->set('login', 0);

        $this->getApplication()->getDispatcher()->dispatch($request);
        $this->assertEquals(0, $this->getView()->login);
    }


    /**
     * @test
     * 已经登陆的Seesion状态 
     */
    public function user_has_login() {
        $request = new Simple('Get', 'Index', 'Login', 'Status');
        \Core\Session::getInstance()->login = 1;

        $this->getApplication()->getDispatcher()->dispatch($request);
        $this->assertEquals(1, $this->getView()->login);
    }

    /**
     * @test
     */
    public function assgin_login_page_url() {
        $request = new Http("/login.html");

        $this->getApplication()->getDispatcher()->dispatch($request);
        $this->assertEquals('http://yourdomain/login.html', $this->getView()->pageurl);
    } 
}