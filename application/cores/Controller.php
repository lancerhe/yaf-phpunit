<?php
/**
 * 应用核心控制器类  \Core\Controller
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-17
 */
namespace Core;

use Yaf\View\Simple;
use Yaf\Dispatcher;

class Controller extends \Yaf\Controller_Abstract {

    public function init() {
        Dispatcher::getInstance()->disableView();
    }

    public function setView(Simple $View) {
        if ( APPLICATION_IS_CLI ) 
            return false;
        $this->_view = $View;
        Dispatcher::getInstance()->setView($View);
        return true;
    }
}