<?php

/**
 * Class Controller_Process
 *
 * @author Lancer He <lancer.he@gmail.com>
 */
class Controller_Process extends Core\Controller\Ajax {
    /**
     * /ajax/process/save
     */
    public function SaveAction() {
        $this->getView()->response("Save Successfully", ['username' => 'Lancer']);
    }

    /**
     * /ajax/process/create
     */
    public function CreateAction() {
        throw new Exception("Create not exist.", 10020);
    }
}