<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-11-22
 */
namespace Tests\TestCase\Action;

use Tests\TestCase;
use Action_AddCategory;

class AddCategoryTest extends TestCase {

    public function setUp() {
        parent::setUp();
        require APPLICATION_ACTIONS_PATH . '/AddCategory.php';
    }

    /**
     * @test
     */
    public function category_has_exists() {
        $stubRequest  = $this->getMockBuilder('\Yaf\Request\Http')
                        ->setConstructorArgs(['/article/addcategory/name/News2'])
                        ->getMock();
        // $stubRequest = new \YafUnit\Request\Http('/article/addcategory/name/News2');
        // $stubResponse = new \Yaf\Response\Http();
        // $stubView     = new \YafUnit\View\Simple(APPLICATION_VIEWS_PATH);
        \Yaf\Dispatcher::getInstance()->getRouter()->route($stubRequest);
        $stubResponse = $this->getMockBuilder('\Yaf\Response\Http')
                        ->disableOriginalConstructor()
                        ->getMock();
        $stubView     = $this->getMockBuilder('\Yaf\View\Simple')
                        ->disableOriginalConstructor()
                        ->getMock();
        // print_r($stubRequest);print_r($stubResponse);print_r($stubView);exit();
        // $Action = new Action_AddCategory($stubRequest, $stubResponse, $stubView);
        // print_r($Action);
    }
}