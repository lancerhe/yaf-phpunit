<?php
/**
 * New Model Test
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-23
 */
namespace Tests\TestCase\Model;

use Tests\TestCase;

class NewTest extends TestCase {

    public $model;

    public function setUp() {
        parent::setUp();
        $this->model = new \Model_New();
    }

    /**
     * @test
     */
    public function addRowFailure() {
        $this->setExpectedException('\Core\Exception\DatabaseException');
        $this->model->addRow();
    }

    /**
     * @test
     */
    public function deleteRowFailure() {
        $this->setExpectedException('\Core\Exception\DatabaseWriteException');
        $this->model->deleteRow();
    }
}