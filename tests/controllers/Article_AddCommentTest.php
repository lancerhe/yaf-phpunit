<?php
/**
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-11-22
 */
namespace Tests\TestCase\Controller;

use Tests\TestCase;
use Controller_Article;
use Model_Comment;

class Article_AddCommentTest extends TestCase {

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
    public function create_comment_while_article_not_found() {
        $this->setExpectedException("\Exception", "Article not exists");

        $stubModelComment = $this->getMockBuilder('\Model_Comment')
            ->disableOriginalConstructor()
            ->setMethods(['createByArticleId'])
            ->getMock();
        $stubModelComment->expects($this->once())
            ->method('createByArticleId')
            ->with( $this->equalTo(2), $this->equalTo(["content" => "c"]))
            ->will( $this->throwException(new \Exception("Article not exists.") ) );

        $stubRequest = $this->_mockRequest();
        $stubRequest->expects($this->exactly(2))
            ->method('getQuery')
            ->withConsecutive(
                [$this->equalTo('article_id')],
                [$this->equalTo('content')]
            )
            ->will($this->onConsecutiveCalls(2, 'c'));

        $Controller = new Controller_Article($stubRequest, $this->_mockResponse(), $this->_mockView());
        $Controller->ModelComment = $stubModelComment;
        $Controller->AddCommentAction();
    }

    /**
     * @test
     */
    public function create_article_and_assign_variables() {
        $stubCreatedComment = $this->getMockBuilder('\Model_Comment')
            ->disableOriginalConstructor()
            ->setMethods(['__get'])
            ->getMock();
        $stubCreatedComment->expects($this->once())
            ->method('__get')
            ->with( $this->equalTo('content') )
            ->will( $this->returnValue("s_1") );

        $stubModelComment = $this->getMockBuilder('\Model_Comment')
            ->disableOriginalConstructor()
            ->setMethods(['createByArticleId'])
            ->getMock();
        $stubModelComment->expects($this->once())
            ->method('createByArticleId')
            ->with( $this->equalTo(2), $this->equalTo(["content" => "c"]))
            ->will( $this->returnValue($stubCreatedComment) );

        $stubRequest = $this->_mockRequest();
        $stubRequest->expects($this->exactly(2))
            ->method('getQuery')
            ->withConsecutive(
                [$this->equalTo('article_id')],
                [$this->equalTo('content')]
            )
            ->will($this->onConsecutiveCalls(2, 'c'));
        
        $stubView = $this->_mockView();
        $stubView->expects($this->once())
            ->method('assign')
            ->with($this->equalTo('content'), $this->equalTo('s_1'));
        $stubView->expects($this->once())
            ->method('display')
            ->with($this->equalTo('article/addcomment.html'));

        $Controller = new Controller_Article($stubRequest, $this->_mockResponse(), $stubView);
        $Controller->ModelComment  = $stubModelComment;
        $Controller->AddCommentAction();
    }
}