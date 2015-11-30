<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-11-22
 */

use Yaf\Action_Abstract;

class Action_AddCategory extends Action_Abstract {

    public $ModelCategory;

    public function init() {
        $this->ModelCategory = new Model_Category;
    }

    /**
     * @url http://yourdomain/article/addcategory/name/news
     */
    public function execute($name) {
        try {
            $this->ModelCategory->name = $name;
            $this->ModelCategory->save();
        } catch (\ActiveRecord\DatabaseException $e ) {
            throw new Exception("Category name exists.");
        }
    }
}