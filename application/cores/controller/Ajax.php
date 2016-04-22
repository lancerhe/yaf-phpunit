<?php
namespace Core\Controller;

use Core\Controller;
use Core\View\Ajax as AjaxView;

/**
 * Class Ajax 异步请求控制器基类
 *
 * @package Core\Controller
 * @author  Lancer He <lancer.he@gmail.com>
 */
class Ajax extends Controller {
    /**
     * init
     */
    public function init() {
        parent::init();
        $this->setView(AjaxView::create());
    }
}