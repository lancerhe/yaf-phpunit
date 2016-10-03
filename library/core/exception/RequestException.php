<?php
namespace Core\Exception;

use Core\Exception;

/**
 * Class RequestException
 *
 * @package Core\Exception
 * @author  Lancer He
 */
class RequestException extends Exception {
    /**
     * @var int
     */
    protected $code = 910;
    /**
     * @var string
     */
    protected $message = "Request failed.";
}