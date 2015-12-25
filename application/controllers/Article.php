<?php
/**
 * Article Controller
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2015-11-11
 */

use Service\Repository\Category as Repository_Category;
use Service\Repository\Article as Repository_Article;
use Service\Repository\Comment as Repository_Comment;
use Core\Controller\Index as Controller_Index;

class Controller_Article extends Controller_Index {

    public $CategoryRepository, $ArticleRepository, $CommentRepository;

    public function init() {
        parent::init();
        $this->CategoryRepository = new Repository_Category;
        $this->ArticleRepository  = new Repository_Article;
        $this->CommentRepository  = new Repository_Comment;
    }

    /**
     * @url http://yourdomain/article/addcategory/?name=news
     */
    public function AddCategoryAction() {
        $name = $this->getRequest()->getQuery('name');
        try {
            $this->CategoryRepository->name = $name;
            $this->CategoryRepository->save();
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

        $Article = $this->ArticleRepository->createByCategoryId($category_id, ["subject" => $subject, "content" => $content]);
        $this->getView()->assign("subject", $Article->subject);
        $this->getView()->display("article/add.html");
    }

    /**
     * @url http://yourdomain/article/addcomment/?article_id=4&content=content
     */
    public function AddCommentAction() {
        $article_id = $this->getRequest()->getQuery('article_id');
        $content    = $this->getRequest()->getQuery('content');

        $Comment = $this->CommentRepository->createByArticleId($article_id, ["content" => $content]);

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