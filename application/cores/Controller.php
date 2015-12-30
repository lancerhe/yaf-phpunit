<?php
namespace Core;

use Yaf\View\Simple as Simple;
use Yaf\Dispatcher as Dispatcher;
use Yaf\Controller_Abstract as Controller_Abstract;

/**
 * Class Controller 应用核心控制器类
 *
 * @package Core
 * @author  Lancer He <lancer.he@gmail.com>
 */
class Controller extends Controller_Abstract {

    public function init() {
        Dispatcher::getInstance()->disableView();
    }

    public function setView(Simple $View) {
        if ( APPLICATION_IS_CLI )
            return false;
        Dispatcher::getInstance()->setView($View);
        $this->_view = $View;
        return true;
    }
}