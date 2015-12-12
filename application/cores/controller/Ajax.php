<?php
/**
 * 应用核心控制器类  \Core\Controller\Ajax 
 * Ajax请求控制器基类
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-05-27
 */
namespace Core\Controller;

use Core\Controller;
use Core\View\Ajax as AjaxView;

class Ajax extends Controller {

    public function init() {
        parent::init();
        $this->setView(AjaxView::create());
    }
}