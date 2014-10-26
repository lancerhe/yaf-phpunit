<?php
/**
 * New Model Test
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-23
 */
namespace YafUnit\TestCase\Model;

use YafUnit\TestCase;

class NewTest extends TestCase {

    /**
     * @test
     */
    public function addRowFailure() {
        $this->setExpectedException('\Core\Exception\DatabaseException');
        $model = new \Model_New();
        $model->addRow();
    }

    /**
     * @test
     */
    public function deleteRowFailure() {
        $this->setExpectedException('\Core\Exception\DatabaseWriteException');
        $model = new \Model_New();
        $model->deleteRow();
    }
}