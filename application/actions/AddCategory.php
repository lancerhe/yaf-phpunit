<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-11-22
 */

use Yaf\Action_Abstract;

class Action_AddCategory extends Action_Abstract {

    /**
     * @url http://yourdomain/article/addcategory/name/news
     */
    public function execute($name) {
        // print_r($this->getRequest());
        // print_r($this->getResponse());
        // print_r($this->getView());
        // exit();
        try {
            $Category = new Model_Category(['name' => $name]);
            $Category->save();
        } catch (\ActiveRecord\DatabaseException $e ) {
            throw new Exception("Category name exists.");
        }
    }
}