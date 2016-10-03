<?php
namespace Util;

/**
 * Class Logger
 *
 * @author Lancer He <lancer.he@gmail.com>
 */
class Logger {
    /**
     * @var
     */
    protected $_output_file;

    /**
     * Logger constructor.
     *
     * @param $output_file
     */
    public function __construct($output_file) {
        $this->_output_file = $output_file;
    }

    /**
     * @param $string
     * @return int
     */
    public function output($string) {
        return file_put_contents($this->_output_file, $string, FILE_APPEND);
    }
}