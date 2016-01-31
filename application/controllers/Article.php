<?php
use Service\Repository\Category as Repository_Category;
use Service\Repository\Article as Repository_Article;
use Service\Repository\Comment as Repository_Comment;
use Core\Controller\Main as Controller_Main;
use Core\View\Main as MainView;

/**
 * Class Controller_Article
 *
 * @author Lancer He <lancer.he@gmail.com>
 */
class Controller_Article extends Controller_Main {
    /**
     * @var Repository_Category
     */
    public $CategoryRepository;
    /**
     * @var Repository_Article
     */
    public $ArticleRepository;
    /**
     * @var Repository_Comment
     */
    public $CommentRepository;

    /**
     * init
     */
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
        $name = $this->_request->getQuery('name');
        try {
            $this->CategoryRepository->name = $name;
            $this->CategoryRepository->save();
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
        $Article     = $this->ArticleRepository->createByCategoryId($category_id, ["subject" => $subject, "content" => $content]);
        $this->getView()->assign("subject", $Article->subject);
        $this->getView()->display("article/add.html");
    }

    /**
     * @url http://yourdomain/article/addcomment/?article_id=4&content=content
     */
    public function AddCommentAction() {
        $article_id = $this->_request->getQuery('article_id');
        $content    = $this->_request->getQuery('content');
        $Comment    = $this->CommentRepository->createByArticleId($article_id, ["content" => $content]);
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