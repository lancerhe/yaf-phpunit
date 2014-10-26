<?php
/**
 * 核心异常类 数据库连接异常
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-23
 */
namespace Core\Exception;

class DatabaseConnectionException extends \Core\Exception {

    protected $code    = 901;

    protected $message = "数据库连接异常";

}