<?php
namespace Core;

use Core\View\Main;
use Exception;
use Yaf\Dispatcher as Dispatcher;
use Yaf\Exception as ApplicationException;

/**
 * Class ExceptionHandler 应用核心异常处理类
 *
 * Yaf自带异常
 * define YAF\ERR\STARTUP_FAILED      512
 * define YAF\ERR\ROUTE_FAILED        513
 * define YAF\ERR\DISPATCH_FAILED     514
 * define YAF\ERR\NOTFOUND\MODULE     515
 * define YAF\ERR\NOTFOUND\CONTROLLER 516
 * define YAF\ERR\NOTFOUND\ACTION     517
 * define YAF\ERR\NOTFOUND\VIEW       518
 * define YAF\ERR\CALL_FAILED         519
 * define YAF\ERR\AUTOLOAD_FAILED     520
 * define YAF\ERR\TYPE_ERROR          521
 *
 * @package Core
 * @author  Lancer He <lancer.he@gmail.com>
 */
class ExceptionHandler {
    /**
     * 将当前ExceptionHandler作为捕捉异常处理
     */
    public function __construct() {
        set_exception_handler([$this, 'handler']);
    }

    /**
     * 处理异常函数, 追踪每个节点进行处理
     *
     * @param Exception $exception
     * @return mixed
     */
    public function handler(Exception $exception) {
        // Catch yaf exception first.
        if ( $exception instanceof ApplicationException )
            return call_user_func_array(
                [$this->getView(), 'frameworkExceptionHandler'], [$exception]
            );
        // 若是自定义异常，大部分是会继承\Core\Exception类，第三方可能是继承\Exception
        foreach ( $exception->getTrace() as $trace ) {
            if ( ! method_exists($trace['class'], 'defaultExceptionHandler') )
                continue;
            // 若对应的Controller/Model/Service等有设置默认捕捉，会将自动执行
            return call_user_func_array(
                [$trace['class'], 'defaultExceptionHandler'],
                [$exception, $this->getView()]
            );
        }
        return call_user_func_array(
            [$this->getView(), 'defaultExceptionHandler'], [$exception]
        );
    }

    /**
     * 通过调度器initView方法可以返回\Core\View核心视图对象
     *
     * @return \Yaf\View_Interface
     */
    public function getView() {
        if ( ! method_exists(Dispatcher::getInstance()->initView(null), 'frameworkExceptionHandler') )
            Dispatcher::getInstance()->setView(Main::create());
        return Dispatcher::getInstance()->initView(null);
    }
}