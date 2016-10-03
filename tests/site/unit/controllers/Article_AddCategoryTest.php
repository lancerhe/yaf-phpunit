<?php
namespace Tests\Unit\Controller;

use Tests\TestCase;
use Controller_Article;

/**
 * Class Article_AddCategoryTest
 *
 * @package Tests\TestCase\Unit\Controller
 * @author  Lancer He <lancer.he@gmail.com>
 */
class Article_AddCategoryTest extends TestCase {

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function _mockRequest() {
        return $this->getMockBuilder('\Yaf\Request\Http')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function _mockResponse() {
        return $this->getMockBuilder('\Yaf\Response\Http')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function _mockView() {
        return $this->getMockBuilder('\Yaf\View\Simple')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @test
     */
    public function category_has_exists() {
        $stubModelCategory = $this->getMockBuilder('\Service\Model\Category')
            ->disableOriginalConstructor()
            ->setMethods(['save', '__set'])
            ->getMock();
        $stubModelCategory->expects($this->once())
            ->method('save')
            ->will( $this->throwException(new \ActiveRecord\DatabaseException("")) );
        $stubModelCategory->expects($this->once())
            ->method('__set')
            ->with($this->equalTo('name'), $this->equalTo('New CategoryName'))
            ->will($this->returnValue('yes'));

        $this->setExpectedException('\Exception', 'Category name exists');

        $stubRequest = $this->_mockRequest();
        $stubRequest->expects($this->any())
            ->method('getQuery')
            ->with($this->equalTo('name'))
            ->will($this->returnValue('New CategoryName'));
        $Controller                = new Controller_Article($stubRequest, $this->_mockResponse(), $this->_mockView());
        $Controller->CategoryModel = $stubModelCategory;
        $Controller->AddCategoryAction();
    }

    /**
     * @test
     */
    public function category_createand_assign_variables() {
        $stubModelCategory = $this->getMockBuilder('\Service\Model\Category')
            ->disableOriginalConstructor()
            ->setMethods(['save', '__set'])
            ->getMock();
        $stubModelCategory->expects($this->once())
            ->method('save')
            ->will( $this->returnValue("yes") );
        $stubModelCategory->expects($this->once())
            ->method('__set')
            ->with($this->equalTo('name'), $this->equalTo('New CategoryName'))
            ->will($this->returnValue('yes'));

        $stubRequest = $this->_mockRequest();
        $stubRequest->expects($this->any())
            ->method('getQuery')
            ->with($this->equalTo('name'))
            ->will($this->returnValue('New CategoryName'));
        $stubView = $this->_mockView();
        $stubView->expects($this->once())
            ->method('assign')
            ->with($this->equalTo('name'), $this->equalTo('New CategoryName'));
        $stubView->expects($this->once())
            ->method('display')
            ->with($this->equalTo('article/addcategory.html'));

        $Controller                = new Controller_Article($stubRequest, $this->_mockResponse(), $stubView);
        $Controller->CategoryModel = $stubModelCategory;
        $Controller->AddCategoryAction();
    }
}