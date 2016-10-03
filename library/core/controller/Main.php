<?php
namespace Core\Controller;

use Core\Controller;
use Core\View\Main as MainView;

/**
 * Class Main Web请求页面级控制器基类
 *
 * @package Core\Controller
 * @author  Lancer He <lancer.he@gmail.com>
 */
class Main extends Controller {
    /**
     * init
     */
    public function init() {
        parent::init();
        $this->setView(MainView::create());
    }
}