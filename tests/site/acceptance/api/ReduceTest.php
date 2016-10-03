<?php
namespace Tests\Acceptance\Api;

use Tests\TestCase;
use YafUnit\Request\Http;

/**
 * Class ReduceTest
 *
 * @package Tests\TestCase\Acceptance\Api
 * @author  Lancer He <lancer.he@gmail.com>
 */
class ReduceTest extends TestCase {

    /**
     * @test
     */
    public function assgin_reduce_disk() {
        $request = new Http("/api/reduce/disk");

        $this->getApplication()->getDispatcher()->dispatch($request);
        $response = $this->getView()->response;
        $this->assertEquals(['disk' => '2000MB'], $response[0]);
        $this->assertEquals(1,                    $response[1]);
    }

    /**
     * @test
     */
    public function response_ajax_format() {
        $request = new Http("/api/reduce/ajaxresponse");

        $this->getApplication()->getDispatcher()->dispatch($request);
        $response = $this->getView()->response;
        $this->assertEquals('Successfully',       $response[0]);
        $this->assertEquals(['disk' => '2000MB'], $response[1]);
    }

    /**
     * @test
     */
    public function throw_exception_on_memory() {
        $this->setExpectedException('\Exception', 'Memory not exist.', '0');
        $request = new Http("/ajax/reduce/memory");

        $this->getApplication()->getDispatcher()->dispatch($request);
    }
}