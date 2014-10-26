<?php
/**
 * 应用核心自动装载类  \Core\ClassLoader
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-06-23
 */
namespace Core;

class ClassLoader {

    /**
     * Class mapping ex: array('Service' => APPLICATION_SERVICES_PATH)
     * @var array
     */
    protected $_mapper = array();

    /**
     * is class could be load
     * @var boolean
     */
    protected $_loader = false;

    /**
     * add class map
     * @param  array $mapper array('Service' => APPLICATION_SERVICES_PATH)
     * @return void
     */
    public function addClassMap($mapper) {
        $this->_mapper = $mapper;
    }

    /**
     * Autoload
     * @param  string $class  Class name which need to autoload.
     * @return boolean
     */
    public function loader($class) {
        $this->_loader = false;
        foreach ($this->_mapper as $prefix => $dir) {
            if ( 0 !== strncmp($class, $prefix, strlen($prefix))) {
                continue;
            }
            $this->_loader = true;
            break;
        }
        if ( ! $this->_loader ) {
            return false;
        }
        $parts  = explode('\\', $class);
        $prefix = array_shift($parts);
        $file   = array_pop($parts);

        $path = rtrim($dir, '/') . DIRECTORY_SEPARATOR;
        if ( ! empty($parts) ) {
            $path .= strtolower(implode(DIRECTORY_SEPARATOR, $parts)) . DIRECTORY_SEPARATOR;
        }
        $path .= $file . '.php';

        // go through the directories to find classes
        if (is_readable($path)) {
            require $path;
            return true;
        }
        return false;
    }
}