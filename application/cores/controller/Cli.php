<?php
/**
 * 应用核心控制器类  \Core\Controller\Cli 
 * 命令行下请求的控制器
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-07-14
 */
namespace Core\Controller;

use Core\Exception\RequestMethodException;

class Cli extends \Core\Controller {

    /**
     * Only request by cli mode.
     */
    public function init() {
        parent::init();
        if ( ! APPLICATION_IS_CLI ) {
            throw new RequestMethodException();
        } 
    }
}
