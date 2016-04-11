<?php
namespace Service\Model;

use ActiveRecord\Model;
use ActiveRecord\RecordNotFound;
use Exception;

/**
 * Class Comment
 *
 * @package Service\Model
 * @author  Lancer He <lancer.he@gmail.com>
 */
class Comment extends Model {
    /**
     * @var string
     */
    public static $table_name = 'comment';
    /**
     * @var array
     */
    public static $belongs_to = [
        [
            'article',
            'foreign_key' => 'article_id',
            'class_name'  => '\Service\Model\Article',
        ],
    ];

    /**
     * @param $article_id
     * @param $row
     * @return Comment
     * @throws Exception
     */
    public function createByArticleId($article_id, $row) {
        try {
            $Article = Article::find($article_id);
        } catch ( RecordNotFound $e ) {
            throw new Exception("Article not exists.");
        }
        return $Article->create_comment($row);
    }
}