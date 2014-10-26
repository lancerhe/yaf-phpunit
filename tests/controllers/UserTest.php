<?php
/**
 * User Controller Test
 * 基于控制器的标准测试，通过RequestSimple / RequestHttp模拟请求完成分发请求对象
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-15
 */
namespace YafUnit\TestCase\Controller;

use YafUnit\TestCase;
use YafUnit\Request\Simple;
use YafUnit\Request\Http;

class UserTest extends TestCase {

    /**
     * @test
     */
    public function indexDisplaySuccess() {
        $request = new Simple("GET", "Index", "User", 'Index');
        self::$_app->getDispatcher()->dispatch($request);

        $this->assertEquals('Lancer He', self::$_view->name);
        $this->assertEquals(27,          self::$_view->age);
    }

    public static function providerUpdateDisplaySuccess() {
        return array(
            array(4, 4),
            array(5, 5),
        );
    }

    /**
     * @test
     * @dataProvider providerUpdateDisplaySuccess
     */
    public function updateDisplaySuccess($id, $expected_id) {
        $request = new Simple("GET", "Index", "User", 'Update');
        $request->setQuery("id", $id);
        self::$_app->getDispatcher()->dispatch($request);

        $this->assertEquals($expected_id, self::$_view->id);
    }

    /**
     * @test
     */
    public function updateDisplayThrowException() {
        $this->setExpectedException('\Core\Exception\RequestParameterException');
        $request = new Simple("GET", "Index", "User", 'Update');
        self::$_app->getDispatcher()->dispatch($request);
    }
}