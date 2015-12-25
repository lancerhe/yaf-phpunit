<?php
/**
 * Comment Model
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-11-21
 */

namespace Service\Repository;

use ActiveRecord\Model;
use ActiveRecord\RecordNotFound;
use Exception;

class Comment extends Model {

    static public $table_name = 'comment';

    static public $belongs_to = [
        [
            'article',
            'foreign_key' => 'article_id',
            'class_name'  => '\Service\Repository\Article'
        ]
    ];

    public function createByArticleId($article_id, $row) {
        try {
            $Article = Article::find($article_id);
        } catch ( RecordNotFound $e ) {
            throw new Exception("Article not exists.");
        }
        return $Article->create_comment($row);
    }
}