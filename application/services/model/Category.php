<?php
namespace Service\Model;

use ActiveRecord\Model;

/**
 * Class Category
 *
 * @package Service\Model
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
            'class_name'  => '\Service\Model\Article',
        ],
    ];
}