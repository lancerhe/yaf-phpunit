<?php
namespace Core\Exception;

use Core\Exception;

/**
 * Class DatabaseException
 *
 * @package Core\Exception
 * @author  Lancer He
 */
class DatabaseException extends Exception {
    /**
     * @var int
     */
    protected $code = 900;
    /**
     * @var string
     */
    protected $message = "Something wrong with database.";
}