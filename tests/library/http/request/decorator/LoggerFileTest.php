<?php
/**
 * HTTP日志装饰类 测试类
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-25
 */
namespace YafUnit\TestCase\Library\Http\Request;

use YafUnit\TestCase;

class Decorator_LoggerFileTest extends TestCase {

    /**
     * @test
     */
    public function write() {
        $http_request = new \Http_Request_Curl();
        $http_request = new \Http_Request_Decorator_LoggerFile($http_request);
        $http_request->setLogFilePath("/httprequest/phpunit.log");
        $http_request->sendRequest("http://127.0.0.1", array("a" => 1));

        $this->assertTrue(file_exists('/tmp/wwwlogs/httprequest/phpunit.log'));
    }

    public function tearDown() {
        parent::tearDown();
        if ( file_exists('/tmp/wwwlogs/httprequest/phpunit.log') ) {
            unlink('/tmp/wwwlogs/httprequest/phpunit.log');
        }
    }
}