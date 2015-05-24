<?php
/**
 * New Controller
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-25
 */
class Controller_New extends \Core\Controller\Index {

    /**
     * @url http://yourdomain/news-255-2.html
     */
    public function indexAction() {
        $id   = $this->getRequest()->getParam('id');
        $page = $this->getRequest()->getParam('page');

        $this->getView()->assign("id",   $id);
        $this->getView()->assign("page", $page);
        $this->getView()->display('new/index.html'); 
    }

    /**
     * @url http://yourdomain/new/list
     */
    public function listAction() {
        throw new Exception("Error Processing Request", 1);
    }

    /**
     * @url http://yourdomain/new/create
     */
    public function createAction() {
        \Yaf\Dispatcher::getInstance()->disableView();
        $model_user = new Model_New();
        $model_user->addRow();
    }


    /**
     * @url http://yourdomain/new/delete
     */
    public function deleteAction() {
        \Yaf\Dispatcher::getInstance()->disableView();

        $model_user = new Model_New();
        try {
            $model_user->deleteRow();
        } catch ( \Exception $exception ) {
            echo "I catch it. so I want to render for it specially.";
        }
    }
}