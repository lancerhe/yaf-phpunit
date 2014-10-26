<?php
/**
 * 核心异常类 数据库通用异常
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-23
 */
namespace Core\Exception;

class DatabaseException extends \Core\Exception {

    protected $code    = 900;

    protected $message = "数据库异常";

}