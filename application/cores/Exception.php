<?php
/**
 * 应用核心异常类  \Core\Exception
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-17
 */
namespace Core;

class Exception extends \Exception{

    /**
     * Initialize exception
     * @param string    $message
     * @param int       $code
     * @param Exception $previous
     */
    public function __construct( $message = null, $code = null, Exception $previous = null ) {
        $message = is_null($message) ? $this->message : $message;
        $code    = is_null($code)    ? $this->code    : intval($code);
        parent::__construct( $message, $code, $previous );
    }
}