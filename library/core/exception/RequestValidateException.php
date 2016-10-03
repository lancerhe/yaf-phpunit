<?php
namespace Core\Exception;

use Core\Exception;

/**
 * Class RequestValidateException
 *
 * @package Core\Exception
 * @author  Lancer He
 */
class RequestValidateException extends Exception {
    /**
     * @var int
     */
    protected $code = 913;
    /**
     * @var string
     */
    protected $message = "Request validate failed.";
}