<?php
/**
 * 单元测试用例 基础类库，mock系统函数
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-11-22
 */
namespace Tests\TestCase\Unit\Library;

use Tests\TestCase;

class LoggerTest extends TestCase {

    /**
     * @test
     */
    public function output_parameter_is_passed_to_method() {
        $output_file = "/tmp/output.log";
        $output      = "This is testing.";

        $MockFunction = new \PHPUnit_Extensions_MockFunction( 'file_put_contents', $this );
        $MockFunction->expects( $this->once() )
            ->with( $this->equalTo($output_file), $this->equalTo($output), FILE_APPEND )
            ->will( $this->returnValue( true ) );

        $Logger = new \Logger($output_file);
        $Logger->output($output);
    }
}
