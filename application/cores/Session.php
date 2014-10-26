<?php
/**
 * 应用核心会话类  \Core\Session 支持Session在WebServer和CLI下执行
 * CLI模式下会模拟一个session_id，同时在/tmp/下产生一个sesscli文件用来保存session信息
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-23
 */
namespace Core;

class Session {

    /**
     * cli instance;
     * @var object
     */
    protected static $_instance = null;

    /**
     * session file
     * @var string
     */
    protected $_session_file = null;

    /**
     * session数组
     * @var array
     */
    protected $_session = array();

    /**
     * session是否已经开启
     * @var boolean
     */
    protected $_started = false;

    /**
     * 单例模式禁止Clone
     */
    private function __clone() {}

    /**
     * 单例模式禁止外部初始化
     */
    private function __construct() {
        $this->_session_file = '/tmp/sess_cliphpunit';
        if ( file_exists($this->_session_file) ) {
            $this->_session = unserialize( file_get_contents($this->_session_file) );
            return;
        }

        file_put_contents($this->_session_file, null);
    }

    /**
     * 返回单例模式
     */
    public static function getInstance() {
        // CLI模式直接使用Yaf原生自带的Session机制($_SESSION原理一致)
        if ( ! APPLICATION_IS_CLI )
            return \Yaf\Session::getInstance();

        // 查看全局空间是否存在实例
        if ( ! is_null(self::$_instance) ) {
            return self::$_instance;
        }

        // 开启模拟Session机制，并注册全局空间
        self::$_instance = new self();
        self::$_instance->start();
        return self::$_instance;
    }

    /**
     * @return string
     */
    public function clear() {
        return $this->_session = array();
    }

    /**
     * 开启Session
     * @return void
     */
    public function start() {
        $this->_started      = true;
    }

    /**
     * 通过name查看Session是否存在
     * @param  string $name
     * @return boolean
     */
    public function has($name) {
        return isset($this->_session[$name]);
    }

    /**
     * 通过name从Session中获取一个值
     * @param  string $name 为空时返回整个sessino
     * @return mixed
     */
    public function get($name='') {
        if ( ! $name )
            return $this->_session;

        return isset($this->_session[$name]) ? $this->_session[$name] : null;
    }

    /**
     * 给指定的name设置一个session值，返回连缀对象
     * @param  string $name
     * @param  mixed  $value
     * @return object
     */
    public function set($name, $value) {
        $this->_session[$name] = $value;
        return $this;
    }

    /**
     * 从session中删除一个值，失败返回false，成功返回连缀对象
     * @param  string $name
     * @return false|object
     */
    public function del($name) {
        if ( ! $this->has($name) ) return false;

        unset($this->_session[$name]);
        return $this;
    }

    /**
     * 魔术方法 通过name查看Session是否存在
     * @param  string $name
     * @return boolean
     */
    public function __isset($name) {
        return $this->has($name);
    }

    /**
     * 魔术方法 通过name查看Session是否存在
     * @param  string $name
     * @return boolean
     */
    public function __unset($name) {
        return $this->del($name);
    }

    /**
     * 魔术方法 通过name从Session中获取一个值
     * @param  string $name
     * @return mixed
     */
    public function __get($name) {
        return $this->get($name);
    }

    /**
     * 魔术方法 给指定的name设置一个session值
     * @param  string $name
     * @param  mixed  $value
     * @return void
     */
    public function __set($name, $value) {
        $this->set($name, $value);
    }

    /**
     * 析构函数 将session存放到tmp文件中
     * @return void
     */
    public function __destruct() {
        file_put_contents($this->_session_file, serialize($this->_session) );
    }
}