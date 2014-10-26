<?php
/**
 * 核心异常类 数据库写入异常
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-23
 */
namespace Core\Exception;

class DatabaseWriteException extends \Core\Exception {

    protected $code    = 902;

    protected $message = "数据库写入异常";

}