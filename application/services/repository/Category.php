<?php
namespace Service\Repository;

use ActiveRecord\Model;

/**
 * Class Category
 *
 * @package Service\Repository
 * @author  Lancer He <lancer.he@gmail.com>
 */
class Category extends Model {
    /**
     * @var string
     */
    public static $table_name = 'category';
    /**
     * @var array
     */
    public static $has_many = [
        [
            'article',
            'foreign_key' => 'category_id',
            'class_name'  => '\Service\Repository\Article',
        ],
    ];
}