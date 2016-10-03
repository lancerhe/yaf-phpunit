<?php
namespace Tests\Acceptance\Controller;

use YafUnit\Request\Http;
use Tests\DbTestCase;

/**
 * Class Article_AddCategoryTest
 *
 * @package Tests\TestCase\Acceptance\Controller
 * @author  Lancer He <lancer.he@gmail.com>
 */
class Article_AddCategoryTest extends DbTestCase {

    public function setUpCategory() {
        $this->getDatabase()->query("INSERT INTO category(id, name) VALUES('1', 'news')");
    }

    /**
     * @test
     */
    public function category_has_exists() {
        $this->setExpectedException("\Exception", "Category name exists.");
        $this->setUpCategory();
        $request = new Http("/article/addcategory");
        $request->setQuery('name', 'news');
        $this->getApplication()->getDispatcher()->dispatch($request);
    }

    /**
     * @test
     */
    public function category_create_and_find_it_in_database() {
        $request = new Http("/article/addcategory");
        $request->setQuery('name', 'news');
        $this->getApplication()->getDispatcher()->dispatch($request);

        $category_name = '';
        $this->getDatabase()->query_and_fetch("SELECT * FROM category WHERE name = 'news';", 
            function($row) use (&$category_name) {$category_name = $row['name'];});
        
        $this->assertEquals('news', $category_name);
    }
}