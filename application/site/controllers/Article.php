<?php
use Service\Model\Category as Model_Category;
use Service\Model\Article as Model_Article;
use Service\Model\Comment as Model_Comment;
use Core\Controller\Main as Controller_Main;
use Core\View\Main as MainView;

/**
 * Class Controller_Article
 *
 * @author Lancer He <lancer.he@gmail.com>
 */
class Controller_Article extends Controller_Main {
    /**
     * @var Model_Category
     */
    public $CategoryModel;
    /**
     * @var Model_Article
     */
    public $ArticleModel;
    /**
     * @var Model_Comment
     */
    public $CommentModel;

    /**
     * init
     */
    public function init() {
        parent::init();
        $this->CategoryModel = new Model_Category;
        $this->ArticleModel  = new Model_Article;
        $this->CommentModel  = new Model_Comment;
    }

    /**
     * @url http://yourdomain/article/addcategory/?name=news
     */
    public function AddCategoryAction() {
        $name = $this->_request->getQuery('name');
        try {
            $this->CategoryModel->name = $name;
            $this->CategoryModel->save();
        } catch ( \ActiveRecord\DatabaseException $e ) {
            throw new Exception("Category name exists.");
        }
        $this->getView()->assign("name", $name);
        $this->getView()->display("article/addcategory.html");
    }

    /**
     * @url http://yourdomain/article/add/?category_id=4&subject=newst&content=content
     */
    public function AddAction() {
        $category_id = $this->_request->getQuery('category_id');
        $subject     = $this->_request->getQuery('subject');
        $content     = $this->_request->getQuery('content');
        $Article     = $this->ArticleModel->createByCategoryId($category_id, ["subject" => $subject, "content" => $content]);
        $this->getView()->assign("subject", $Article->subject);
        $this->getView()->display("article/add.html");
    }

    /**
     * @url http://yourdomain/article/addcomment/?article_id=4&content=content
     */
    public function AddCommentAction() {
        $article_id = $this->_request->getQuery('article_id');
        $content    = $this->_request->getQuery('content');
        $Comment    = $this->CommentModel->createByArticleId($article_id, ["content" => $content]);
        $this->getView()->assign("content", $Comment->content);
        $this->getView()->display("article/addcomment.html");
    }

    /**
     * @param Exception $exception
     * @param MainView  $view
     */
    public static function defaultExceptionHandler(Exception $exception, MainView $view) {
        $view->defaultExceptionHandler($exception);
        echo sprintf("<p><font color='#008b8b'>Triggered <strong>defaultExceptionHandler</strong> in the controller: Controller_Article.</font> </p>");
    }
}