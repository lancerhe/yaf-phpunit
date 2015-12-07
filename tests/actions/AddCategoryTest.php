<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-11-22
 */
namespace Tests\TestCase\Action;

use Tests\TestCase;
use Action_AddCategory;

class AddCategoryTest extends TestCase {

    protected function _mockRequest() {
        return $this->getMockBuilder('\Yaf\Request\Http')
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function _mockResponse() {
        return $this->getMockBuilder('\Yaf\Response\Http')
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function _mockView() {
        return $this->getMockBuilder('\Yaf\View\Simple')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @test
     */
    public function category_has_exists() {
        $stubModelCategory = $this->getMockBuilder('\Model_Category')
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

        $this->setExpectedException("\Exception", "Category name exists");

        $stubRequest = $this->_mockRequest();
        $stubRequest->expects($this->any())
            ->method('getQuery')
            ->with($this->equalTo('name'))
            ->will($this->returnValue('New CategoryName'));
        $Action = new Action_AddCategory($stubRequest, $this->_mockResponse(), $this->_mockView());
        $Action->ModelCategory = $stubModelCategory;
        $Action->execute();
    }

    /**
     * @test
     */
    public function category_create() {
        $stubModelCategory = $this->getMockBuilder('\Model_Category')
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
        $Action = new Action_AddCategory($stubRequest, $this->_mockResponse(), $this->_mockView());
        $Action->ModelCategory = $stubModelCategory;
        $Action->execute();
    }
}