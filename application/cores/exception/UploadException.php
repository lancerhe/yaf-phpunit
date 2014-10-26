<?php
/**
 * 核心异常类 上传通用异常
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-23
 */
namespace Core\Exception;

class UploadException extends \Core\Exception {

    protected $code    = 920;

    protected $message = "上传出现异常";

}