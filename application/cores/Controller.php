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
    /**
     * @var Simple
     */
    protected $_coreView = null;

    /**
     *
     */
    public function init() {
        Dispatcher::getInstance()->disableView();
    }

    /**
     * @param Simple $View
     * @return bool
     */
    public function setView(Simple $View) {
        if ( APPLICATION_IS_CLI )
            return false;

        $this->_coreView = $View;
        Dispatcher::getInstance()->setView($View);
        return true;
    }

    /**
     * @return Simple
     */
    public function getView() {
        if ( $this->_coreView instanceof Simple ) {
            return $this->_coreView;
        }
        return parent::getView();
    }
}