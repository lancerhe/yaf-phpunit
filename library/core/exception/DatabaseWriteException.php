<?php
namespace Core\Exception;

use Core\Exception;

/**
 * Class DatabaseWriteException
 *
 * @package Core\Exception
 * @author  Lancer He
 */
class DatabaseWriteException extends Exception {
    /**
     * @var int
     */
    protected $code = 902;
    /**
     * @var string
     */
    protected $message = "Database write failed.";
}