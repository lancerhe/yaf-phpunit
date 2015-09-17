<?php
/**
 * New Controller Test
 * 基于控制器的标准测试，通过RequestSimple / RequestHttp模拟请求完成分发请求对象
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-23
 */
namespace Tests\TestCase\Controller;

use Tests\TestCase;
use YafUnit\Request\Simple;
use YafUnit\Request\Http;

class NewTest extends TestCase {

    /**
     * @test
     */
    public function indexFromSimpleRequest() {
        $request = new Simple("GET", "Index", "New", 'Index', array('id' => 1, 'page'=>4) );
        self::$_app->getDispatcher()->dispatch($request);

        $this->assertEquals(1, self::$_view->id);
        $this->assertEquals(4, self::$_view->page);
    }

    /**
     * @test
     */
    public function indexFromCustomRegexRouter() {
        $request = new Http("/news-255-2.html");
        self::$_app->getDispatcher()->dispatch($request);

        $this->assertEquals(255,      self::$_view->id);
        $this->assertEquals(2,        self::$_view->page);
    }

    /**
     * @test 
     */
    public function createDisplayThrowException() {
        $this->setExpectedException('\Core\Exception\DatabaseException');

        $request = new Http("/new/create");
        self::$_app->getDispatcher()->dispatch($request);
    }

    /**
     * @test 
     */
    public function deleteDisplayThrowException() {
        $this->expectOutputString('I catch it. so I want to render for it specially.');

        $request = new Http("/new/delete");
        self::$_app->getDispatcher()->dispatch($request);
    }
}