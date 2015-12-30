<?php
namespace Tests\Acceptance\Controller;

use YafUnit\Request\Http;
use Tests\DbTestCase;

/**
 * Class Article_AddCommentTest
 *
 * @package Tests\TestCase\Acceptance\Controller
 * @author  Lancer He <lancer.he@gmail.com>
 */
class Article_AddCommentTest extends DbTestCase {

    /**
     * @throws \ActiveRecord\DatabaseException
     */
    public function setUpArticle() {
        $this->getDatabase()->query("INSERT INTO article(id, category_id, subject, content) VALUES('1', '1', 's', 'c')");
    }

    /**
     * @test
     */
    public function article_not_exists() {
        $this->setExpectedException("\Exception", "Article not exists.");

        $request = new Http("/article/addcomment");
        $request->setQuery('article_id', '1');
        $this->getApplication()->getDispatcher()->dispatch($request);
    }

    /**
     * @test
     */
    public function comment_create_and_find_it_in_database() {
        $this->setUpArticle();

        $request = new Http("/article/addcomment");
        $request->setQuery('article_id', '1');
        $request->setQuery('content',    'r');
        $this->getApplication()->getDispatcher()->dispatch($request);

        $comment = null;
        $this->getDatabase()->query_and_fetch("SELECT * FROM comment WHERE id = 1;", 
            function($row) use (&$comment) {$comment = $row;});

        $this->assertEquals('1', $comment['article_id']);
        $this->assertEquals('r', $comment['content']);
    }
}