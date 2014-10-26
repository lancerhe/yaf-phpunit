<?php
/**
 * 核心异常类 请求方式异常
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-23
 */
namespace Core\Exception;

class RequestMethodException extends \Core\Exception {

    protected $code    = 911;

    protected $message = "请求方式异常";

}