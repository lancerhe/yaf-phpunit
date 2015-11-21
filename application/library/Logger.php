<?php
/**
 * Logger  
 */
class Logger{

    protected $_output_file;

    public function __construct($output_file) {
        $this->_output_file = $output_file;
    }

    public function output($string) {
        return file_put_contents($this->_output_file, $string, FILE_APPEND);
    }
}