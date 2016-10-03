<?php
namespace Tests\Acceptance\Controller;

use YafUnit\Request\Http;
use Tests\DbTestCase;

/**
 * Class Article_AddTest
 *
 * @package Tests\TestCase\Acceptance\Controller
 * @author  Lancer He <lancer.he@gmail.com>
 */
class Article_AddTest extends DbTestCase {

    /**
     * @throws \ActiveRecord\DatabaseException
     */
    public function setUpCategory() {
        $this->getDatabase()->query("INSERT INTO category(id, name) VALUES('1', 'news')");
    }

    /**
     * @test
     */
    public function category_not_exists() {
        $this->setExpectedException("\Exception", "Category not exists.");

        $request = new Http("/article/add");
        $request->setQuery('category_id', '1');
        $this->getApplication()->getDispatcher()->dispatch($request);
    }

    /**
     * @test
     */
    public function category_create_and_find_it_in_database() {
        $this->setUpCategory();

        $request = new Http("/article/add");
        $request->setQuery('category_id', '1');
        $request->setQuery('subject',     's');
        $request->setQuery('content',     'c');
        $this->getApplication()->getDispatcher()->dispatch($request);

        $article = null;
        $this->getDatabase()->query_and_fetch("SELECT * FROM article WHERE id = 1;", 
            function($row) use (&$article) {$article = $row;});
        $this->assertEquals('1', $article['category_id']);
        $this->assertEquals('s', $article['subject']);
        $this->assertEquals('c', $article['content']);
    }
}