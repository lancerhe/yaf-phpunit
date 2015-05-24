<?php
/**
 * User Controller
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-15
 */
class Controller_User extends \Core\Controller\Index {

    /**
     * @url http://yourdomain/user
     */
    public function indexAction() {
        $this->getView()->assign('age',  27);
        $this->getView()->assign('name', 'Lancer He');
    }

    /**
     * @url http://yourdomain/user/update?id=1
     */
    public function updateAction() {
        $id = $this->getRequest()->getQuery('id');
        if ( ! $id ) {
            throw new \Core\Exception\RequestParameterException();
        }
        $this->getView()->assign("id", $id);
    }


    /**
     * 默认异常处理机制
     * @param  Exception $exception
     * @return
     */
    public static function defaultExceptionHandler( $exception, $view ) {
        echo "<pre>";
        print_r( $exception->getMessage() );
        echo " This error in controller. we must to render it.";
        echo "</pre>";
    }
}