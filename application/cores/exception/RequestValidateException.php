<?php
/**
 * 核心异常类 请求字段验证异常
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-23
 */
namespace Core\Exception;

class RequestValidateException extends \Core\Exception {

    protected $code    = 913;

    protected $message = "请求字段验证异常";

}