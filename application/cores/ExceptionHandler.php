<?php
/**
 * 应用核心异常处理类  \Core\ExceptionHandler
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-17
 */
namespace Core;

/**
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
 */
class ExceptionHandler {

    /**
     * 将当前ExceptionHandler作为捕捉异常处理
     */
    public function __construct() {
        set_exception_handler(array($this, 'handler'));
    }


    /**
     * 处理异常函数, 追踪每个节点进行处理
     * 异常对象可以是yaf自身的异常类，也可以是继承PHP自身的异常类，注意Yaf异常类并不是继承PHP的异常类
     * @param  $exception  异常对象
     * @return void
     */
    public function handler( $exception ) {
        // 若是Yaf定义的异常被接收到
        if ( $exception instanceof \Yaf\Exception ) {
            $this->yafExceptionHandler( $exception );
            return;
        }

        // 若是自定义异常，大部分是会继承\Core\Exception类，第三方可能是继承\Exception
        foreach ( $exception->getTrace() as $trace ) {
            if ( ! method_exists($trace['class'], 'defaultExceptionHandler' ) ) 
                continue;

            // 若对应的Controller/Model/Service等有设置默认捕捉，会将自动执行
            call_user_func_array(
                array( $trace['class'], 'defaultExceptionHandler' ), 
                array( $exception, $this->getView() )
            );
            exit();
        }

        $this->defaultExceptionHandler( $exception );
    }


    /**
     * Yaf错误模板渲染
     * @return string
     */
    public function yafExceptionHandler( \Yaf\Exception $exception ) {
        $this->getView()->setScriptPath(APPLICATION_VIEWS_PATH);
        $this->getView()->assign("exception", $exception);
        $this->getView()->display('error/error_yaf.html');
    }


    /**
     * 错误模板渲染
     * @return string
     */
    public function defaultExceptionHandler( \Exception $exception ) {
        $this->getView()->setScriptPath(APPLICATION_VIEWS_PATH);
        $this->getView()->assign("exception", $exception);
        $this->getView()->display('error/error.html');
    }


    /**
     * 通过调度器initView方法可以返回\Core\View核心视图对象
     * @return \Yaf\View_Interface  $view   视图对象
     */
    public function getView() {
        return \Yaf\Dispatcher::getInstance()->initView( APPLICATION_VIEWS_PATH );
    }
}