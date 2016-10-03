<?php
namespace Core\Controller;

use Core\Controller;
use Core\Exception\RequestMethodException;

/**
 * Class Cli 命令行下请求的控制器
 *
 * @package Core\Controller
 * @author  Lancer He <lancer.he@gmail.com>
 */
class Cli extends Controller {
    /**
     * Only request by cli mode.
     */
    public function init() {
        if ( ! APPLICATION_IS_CLI )
            throw new RequestMethodException();
    }
}
