<?php
/**
 * Util_Validate Library Test
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-15
 */
namespace Tests\TestCase\Library\Util;

use Tests\TestCase;

class ValidateTest extends TestCase {

    /**
     * @test
     */
    public function isEmailAddr() {
        $success = \Util_Validate::isEmailAddr( 'lancer.he@gmail.com' );
        $failure = \Util_Validate::isEmailAddr( 'lancer.hegmail.com' );

        $this->assertEquals(true, $success);
        $this->assertEquals(false, $failure);
    }


    /**
     * @test
     */
    public function isHttpUrl() {
        $success = \Util_Validate::isHttpUrl( 'http://www.baidu.com' );
        $failure = \Util_Validate::isHttpUrl( 'www.baidu.com' );

        $this->assertEquals(true, $success);
        $this->assertEquals(false, $failure);
    }
}