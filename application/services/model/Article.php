<?php
namespace Service\Model;

use ActiveRecord\Model;
use ActiveRecord\RecordNotFound;
use Exception;

/**
 * Class Article
 *
 * @package Service\Model
 * @author  Lancer He <lancer.he@gmail.com>
 */
class Article extends Model {
    /**
     * @var string
     */
    public static $table_name = 'article';
    /**
     * @var array
     */
    public static $has_many = [
        [
            'comment',
            'foreign_key' => 'article_id',
            'class_name'  => '\Service\Model\Comment',
        ],
    ];

    /**
     * @param $category_id
     * @param $row
     * @return Article
     * @throws Exception
     */
    public function createByCategoryId($category_id, $row) {
        try {
            $Category = Category::find($category_id);
        } catch ( RecordNotFound $e ) {
            throw new Exception("Category not exists.");
        }
        return $Category->create_article($row);
    }
}