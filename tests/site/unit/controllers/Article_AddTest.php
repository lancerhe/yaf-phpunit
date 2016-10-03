<?php
namespace Tests\Unit\Controller;

use Tests\TestCase;
use Controller_Article;
use Article;

/**
 * Class Article_AddTest
 *
 * @package Tests\TestCase\Unit\Controller
 * @author  Lancer He <lancer.he@gmail.com>
 */
class Article_AddTest extends TestCase {

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
    public function create_article_while_category_not_found() {
        $this->setExpectedException("\Exception", "Category not exists");

        $stubModelArticle = $this->getMockBuilder('\Service\Model\Article')
            ->disableOriginalConstructor()
            ->setMethods(['createByCategoryId'])
            ->getMock();
        $stubModelArticle->expects($this->once())
            ->method('createByCategoryId')
            ->with( $this->equalTo(2), $this->equalTo(["subject" => "s", "content" => "c"]))
            ->will( $this->throwException(new \Exception("Category not exists.") ) );

        $stubRequest = $this->_mockRequest();
        $stubRequest->expects($this->exactly(3))
            ->method('getQuery')
            ->withConsecutive(
                [$this->equalTo('category_id')],
                [$this->equalTo('subject')],
                [$this->equalTo('content')]
            )
            ->will($this->onConsecutiveCalls(2, 's', 'c'));

        $Controller               = new Controller_Article($stubRequest, $this->_mockResponse(), $this->_mockView());
        $Controller->ArticleModel = $stubModelArticle;
        $Controller->AddAction();
    }

    /**
     * @test
     */
    public function create_article_and_assign_variables() {
        $stubCreatedArticle = $this->getMockBuilder('\Service\Model\Category')
            ->disableOriginalConstructor()
            ->setMethods(['__get'])
            ->getMock();
        $stubCreatedArticle->expects($this->once())
            ->method('__get')
            ->with( $this->equalTo('subject') )
            ->will( $this->returnValue("s_1") );

        $stubModelArticle = $this->getMockBuilder('\Service\Model\Article')
            ->disableOriginalConstructor()
            ->setMethods(['createByCategoryId'])
            ->getMock();
        $stubModelArticle->expects($this->once())
            ->method('createByCategoryId')
            ->with( $this->equalTo(2), $this->equalTo(["subject" => "s", "content" => "c"]))
            ->will( $this->returnValue($stubCreatedArticle) );

        $stubRequest = $this->_mockRequest();
        $stubRequest->expects($this->exactly(3))
            ->method('getQuery')
            ->withConsecutive(
                [$this->equalTo('category_id')],
                [$this->equalTo('subject')],
                [$this->equalTo('content')]
            )
            ->will($this->onConsecutiveCalls(2, 's', 'c'));
        
        $stubView = $this->_mockView();
        $stubView->expects($this->once())
            ->method('assign')
            ->with($this->equalTo('subject'), $this->equalTo('s_1'));
        $stubView->expects($this->once())
            ->method('display')
            ->with($this->equalTo('article/add.html'));

        $Controller               = new Controller_Article($stubRequest, $this->_mockResponse(), $stubView);
        $Controller->ArticleModel = $stubModelArticle;
        $Controller->AddAction();
    }
}