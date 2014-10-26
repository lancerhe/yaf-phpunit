<?php
/**
 * Service User Info Testcase.
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-26
 */
namespace YafUnit\TestCase\Service\User;

use YafUnit\TestCase;

class InfoTest extends TestCase {

    /**
     * @test
     */
    public function requestAccountBalance() {
        $service_info = new \Service\User\Info();
        $response = $service_info->requestAccountBalance();
        
        $this->assertEquals(200, $response['value']);
    }
}