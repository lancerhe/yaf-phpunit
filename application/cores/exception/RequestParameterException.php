<?php
/**
 * 核心异常类 请求参数异常
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-23
 */
namespace Core\Exception;

class RequestParameterException extends \Core\Exception {

    protected $code    = 912;

    protected $message = "请求参数异常";

}