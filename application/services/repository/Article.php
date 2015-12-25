<?php
/**
 * Article Model
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-11-21
 */

namespace Service\Repository;

use ActiveRecord\Model;
use ActiveRecord\RecordNotFound;
use Exception;

class Article extends Model {

    static public $table_name = 'article';

    static public $has_many = [
        [
            'comment',
            'foreign_key' => 'article_id',
            'class_name'  => '\Service\Repository\Comment',
        ],
    ];

    public function createByCategoryId($category_id, $row) {
        try {
            $Category = Category::find($category_id);
        } catch (RecordNotFound $e ) {
            throw new Exception("Category not exists.");
        }
        return $Category->create_article($row);
    }
}