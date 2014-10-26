<?php
/**
 * 核心异常类 请求通用异常
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-23
 */
namespace Core\Exception;

class RequestException extends \Core\Exception {

    protected $code    = 910;

    protected $message = "请求异常";

}