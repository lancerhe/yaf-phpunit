<?php
/**
 * User Model Test
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-15
 */
namespace Tests\TestCase\Model;

use Tests\TestCase;

class UserTest extends TestCase {

    public static function providerFetchRowId() {
        return array(
            array(4, array(
                'id'   => "5",
                'name' => 'Lancer He',
                'sex'  => "1",
            )),
            array(5, array(
                'id'   => "5",
                'name' => 'Lancer He',
                'sex'  => "1",
            )),
        );
    }

    /**
     * @test
     * @dataProvider providerFetchRowId
     */
    public function fetchRowById4($id, $expected_row) {
        $model = new \Model_User();
        $row   = $model->fetchRowById($id);

        $this->assertEquals($expected_row,  $row);
        $this->assertInternalType('string', $row['name']);
        $this->assertStringMatchesFormat('%i', $row['id']);
        $this->assertStringMatchesFormat('%i', $row['sex']);
    }


    /**
     * @test
     */
    public function fetchCount() {
        $model = new \Model_User();
        $count = $model->fetchCount();

        $this->assertEquals(1600, $count);
    }
}