<?php
/**
 * Comment Model
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-11-21
 */

use ActiveRecord\Model;
use ActiveRecord\RecordNotFound;

class Model_Comment extends ActiveRecord\Model {

    static public $table_name = 'comment';

    static public $belongs_to = [
        [
            'article',
            'foreign_key' => 'article_id',
            'class_name'  => '\Model_Article'
        ]
    ];

    public function createByArticleId($article_id, $row) {
        try {
            $Article = Model_Article::find($article_id);
        } catch ( RecordNotFound $e ) {
            throw new Exception("Article not exists.");
        }
        return $Article->create_comment($row);
    }
}