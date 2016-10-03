<?php

/**
 * Class Controller_Reduce
 *
 * @author Lancer He <lancer.he@gmail.com>
 */
class Controller_Reduce extends Core\Controller\Api {
    /**
     * /api/reduce/disk
     */
    public function DiskAction() {
        $this->getView()->response(['disk' => '2000MB'], 1);
    }

    /**
     * 一些特殊业务需要 ajax view
     * /api/reduce/ajaxresponse
     */
    public function AjaxResponseAction() {
        $this->setView(\Core\View\Ajax::create());
        $this->getView()->response("Successfully", ['disk' => '2000MB']);
    }

    /**
     * /api/reduce/memory
     */
    public function MemoryAction() {
        throw new Exception("Memory not exist.");
    }
}