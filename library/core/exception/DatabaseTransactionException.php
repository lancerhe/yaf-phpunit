<?php
namespace Core\Exception;

use Core\Exception;

/**
 * Class DatabaseTransactionException
 *
 * @package Core\Exception
 * @author  Lancer He
 */
class DatabaseTransactionException extends Exception {
    /**
     * @var int
     */
    protected $code = 903;
    /**
     * @var string
     */
    protected $message = "Database commit failed.";
}