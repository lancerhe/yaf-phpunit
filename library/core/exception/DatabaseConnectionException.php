<?php
namespace Core\Exception;

use Core\Exception;

/**
 * Class DatabaseConnectionException
 *
 * @package Core\Exception
 * @author  Lancer He
 */
class DatabaseConnectionException extends Exception {
    /**
     * @var int
     */
    protected $code = 901;
    /**
     * @var string
     */
    protected $message = "Database connect failed.";
}