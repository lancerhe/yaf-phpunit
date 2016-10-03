<?php
namespace Tests\Unit\Library\Util;

use Tests\TestCase;
use Util\Logger;

/**
 * Class LoggerTest
 *
 * @package Tests\TestCase\Unit\Library
 * @author  Lancer He <lancer.he@gmail.com>
 */
class LoggerTest extends TestCase {
    /**
     * @test
     */
    public function output_parameter_is_passed_to_method() {
        $output_file = "/tmp/output.log";
        $output      = "This is testing.";
        $MockFunction = new \PHPUnit_Extensions_MockFunction('file_put_contents', $this);
        $MockFunction->expects($this->once())
            ->with($this->equalTo($output_file), $this->equalTo($output), FILE_APPEND)
            ->will($this->returnValue(true));
        $Logger = new Logger($output_file);
        $Logger->output($output);
    }
}