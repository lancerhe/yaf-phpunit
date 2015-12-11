<?php
/**
 * User Controller
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-15
 */
class Controller_Article extends \Core\Controller\Index {

    public $ModelCategory, $ModelArticle;

    public function init() {
        $this->ModelCategory = new Model_Category;
        $this->ModelArticle  = new Model_Article;
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
     * @url http://yourdomain/article/add/
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
     * @url http://yourdomain/article/addcomment/
     */
    public function AddCommentAction() {
        $article_id = $this->getRequest()->getQuery('article_id');
        $content    = $this->getRequest()->getQuery('content');
        try {
            $Article = Model_Article::find($article_id);
        } catch (\ActiveRecord\RecordNotFound $e ) {
            throw new Exception("Article not exists.");
        }

        $Comment = $Article->create_comment(["content" => $content]);
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