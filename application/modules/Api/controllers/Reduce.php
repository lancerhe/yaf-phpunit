<?php
/**
 * Api Reduce Controller
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-05-24
 */
class Controller_Reduce extends Core\Controller\Api {

    /**
     * /api/reduce/memory
     */
    public function DiskAction() {
        $this->getView()->display(['disk' => '2000MB'], 1);
    }

    /**
     * /api/reduce/memory
     */
    public function MemoryAction() {
        throw new Exception("Memory not exist.", 10020);
    }
}