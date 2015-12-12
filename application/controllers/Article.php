<?php
/**
 * Article Controller
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-11-11
 */
class Controller_Article extends \Core\Controller\Index {

    public $ModelCategory, $ModelArticle, $ModelComment;

    public function init() {
        parent::init();
        $this->ModelCategory = new Model_Category;
        $this->ModelArticle  = new Model_Article;
        $this->ModelComment  = new Model_Comment;
    }

    /**
     * @url http://yourdomain/article/addcategory/?name=news
     */
    public function AddCategoryAction() {
        $name = $this->getRequest()->getQuery('name');
        try {
            $this->ModelCategory->name = $name;
            $this->ModelCategory->save();
        } catch (\ActiveRecord\DatabaseException $e ) {
            throw new Exception("Category name exists.");
        }
        $this->getView()->assign("name", $name);
        $this->getView()->display("article/addcategory.html");
    }

    /**
     * @url http://yourdomain/article/add/?category_id=4&subject=newst&content=content
     */
    public function AddAction() {
        $category_id = $this->getRequest()->getQuery('category_id');
        $subject     = $this->getRequest()->getQuery('subject');
        $content     = $this->getRequest()->getQuery('content');

        $Article = $this->ModelArticle->createByCategoryId($category_id, ["subject" => $subject, "content" => $content]);

        $this->getView()->assign("subject", $Article->subject);
        $this->getView()->display("article/add.html");
    }

    /**
     * @url http://yourdomain/article/addcomment/?article_id=4&content=content
     */
    public function AddCommentAction() {
        $article_id = $this->getRequest()->getQuery('article_id');
        $content    = $this->getRequest()->getQuery('content');

        $Comment = $this->ModelComment->createByArticleId($article_id, ["content" => $content]);

        $this->getView()->assign("content", $Comment->content);
        $this->getView()->display("article/addcomment.html");
    }


    /**
     * 默认异常处理机制
     * @param  Exception $exception
     * @return
     */
    public static function defaultExceptionHandler( $exception, $view ) {
        echo "<pre>";
        print_r( $exception->getMessage() );
        echo " This error in controller. we must to render it.";
        echo "</pre>";
    }
}