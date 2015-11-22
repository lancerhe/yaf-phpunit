<?php
/**
 * User Controller
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-15
 */
class Controller_Article extends \Core\Controller\Index {

    /**
     * @url http://yourdomain/article/addcategory/name/news
     */
    public function AddCategoryAction($name) {
        try {
            $Category = new Model_Category(['name' => $name]);
            $Category->save();
        } catch (\ActiveRecord\DatabaseException $e ) {
            throw new Exception("Category name exists.");
        }
    }
    /**
     * @url http://yourdomain/article/addcomment/
     */
    public function AddCommentAction() {
        $article_id = $this->getRequest()->getQuery('article_id');
        $content     = $this->getRequest()->getQuery('content');
        try {
            $Article = Model_Article::find($article_id);
        } catch (\ActiveRecord\RecordNotFound $e ) {
            throw new Exception("Article not exists.");
        }

        $Comment = $Article->create_comment(["content" => $content]);
    }

    /**
     * @url http://yourdomain/article/add/
     */
    public function AddAction() {
        $category_id = $this->getRequest()->getQuery('category_id');
        $subject     = $this->getRequest()->getQuery('subject');
        $content     = $this->getRequest()->getQuery('content');
        try {
            $Category = Model_Category::find($category_id);
        } catch (\ActiveRecord\RecordNotFound $e ) {
            throw new Exception("Category not exists.");
        }
        
        $Article = $Category->create_article(["subject" => $subject, "content" => $content]);
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