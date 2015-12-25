<?php
/**
 * Category Model
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-11-22
 */

namespace Service\Repository;

use ActiveRecord\Model;

class Category extends Model {

    static public $table_name = 'category';

    static public $has_many = [
        [
            'article',
            'foreign_key' => 'category_id',
            'class_name'  => '\Service\Repository\Article'
        ]
    ];
}