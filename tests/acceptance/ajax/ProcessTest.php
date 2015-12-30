<?php
namespace Tests\Acceptance\Ajax;

use Tests\TestCase;
use YafUnit\Request\Http;

/**
 * Class ProcessTest
 *
 * @package Tests\TestCase\Acceptance\Ajax
 * @author  Lancer He <lancer.he@gmail.com>
 */
class ProcessTest extends TestCase {

    /**
     * @test
     */
    public function assgin_save_response() {
        $request = new Http("/ajax/process/save");

        $this->getApplication()->getDispatcher()->dispatch($request);
        $response = $this->getView()->response;
        $this->assertEquals('Save Successfully',       $response[0]);
        $this->assertEquals(['username' => 'Lancer'],  $response[1]);
    }

    /**
     * @test
     */
    public function throw_exception_on_create() {
        $this->setExpectedException('\Exception', 'Create not exist.', '10020');
        $request = new Http("/ajax/process/create");

        $this->getApplication()->getDispatcher()->dispatch($request);
    }
}