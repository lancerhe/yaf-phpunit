<?php
namespace Core\Exception;

use Core\Exception;

/**
 * Class UploadException
 *
 * @package Core\Exception
 * @author  Lancer He
 */
class UploadException extends Exception {
    /**
     * @var int
     */
    protected $code = 920;
    /**
     * @var string
     */
    protected $message = "Upload failed.";
}