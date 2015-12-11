<?php
/**
 * Article Model
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-11-21
 */

use ActiveRecord\Model;

class Model_Article extends ActiveRecord\Model {

    static public $table_name = 'article';

    static public $has_many = [
        [
            'comment',
            'foreign_key' => 'article_id',
            'class_name' => '\Model_Comment'
        ],
    ];

    public function createByCategoryId($category_id, $row) {
        try {
            $Category = Model_Category::find($category_id);
        } catch (\ActiveRecord\RecordNotFound $e ) {
            throw new Exception("Category not exists.");
        }
        return $Category->create_article($row);
    }
}