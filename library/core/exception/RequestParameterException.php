<?php
namespace Core\Exception;

use Core\Exception;

/**
 * Class RequestParameterException
 *
 * @package Core\Exception
 * @author  Lancer He
 */
class RequestParameterException extends Exception {
    /**
     * @var int
     */
    protected $code = 912;
    /**
     * @var string
     */
    protected $message = "Request parameter.";
}