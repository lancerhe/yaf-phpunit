<?php
/**
 * User Model Test
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-15
 */
namespace Tests\TestCase\Model;

use Tests\TestCase;

class UserTest extends TestCase {

    public $model;

    public function setUp() {
        parent::setUp();
        $this->model = new \Model_User();
    }

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
    public function fetchRowById($id, $expected_row) {
        $row   = $this->model->fetchRowById($id);

        $this->assertEquals($expected_row,  $row);
        $this->assertInternalType('string', $row['name']);
        $this->assertStringMatchesFormat('%i', $row['id']);
        $this->assertStringMatchesFormat('%i', $row['sex']);
    }


    /**
     * @test
     */
    public function fetchCount() {
        $count = $this->model->fetchCount();
        $this->assertEquals(1600, $count);
    }
}