<?php
namespace Core\Exception;

use Core\Exception;

/**
 * Class RequestMethodException
 *
 * @package Core\Exception
 * @author  Lancer He
 */
class RequestMethodException extends Exception {
    /**
     * @var int
     */
    protected $code = 911;
    /**
     * @var string
     */
    protected $message = "Request method failed.";
}