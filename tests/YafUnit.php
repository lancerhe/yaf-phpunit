<?php
namespace YafUnit\Request;

/**
 * \YafUnit\Request\Http 模拟URL路径Request对象
 * \Yaf\Request\Http 可被继承
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-18
 */
final class Http extends \Yaf\Request\Http {

    public function __construct($request_uri = null, $base_uri = null) {
        parent::__construct($request_uri, $base_uri);

        // 解析Url的GET参数
        $this->_initParseRequestUri($request_uri);

        // 默认使用GET请求
        $this->setMethod('Get');

        // 手动分配路由，若已经继承Yaf\Request\Http类，不需要手动路由;
        // \Yaf\Dispatcher::getInstance()->getRouter()->route($this);

        // 初始化一个新的测试请求时，清空模板
        \YafUnit\View::getInstance()->clear();
    }

    protected function _initParseRequestUri($request_uri) {
        $url_info = parse_url( $request_uri );
        if ( ! isset($url_info['query']) ) return;

        parse_str( $url_info['query'], $query);
        if ( empty($query) ) return;

        foreach ($query as $key => $value) {
            $this->setQuery($key, $value);
        }
    }

    public function setMethod($method) {
        $this->method = $method;
    }


    public function getQuery($name = null) {
        if (is_null($name)) return $_GET;
        return isset($_GET[$name]) ? $_GET[$name] : null;
    }

    public function getPost($name = null) {
        if (is_null($name)) return $_POST;
        return isset($_POST[$name]) ? $_POST[$name] : null;
    }

    public function getCookie($name = null) {
        if ( is_null($name) ) return $_COOKIE;
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }

    public function getFiles($name = null) {
        if (is_null($name)) return $_FILES;
        return isset($_FILES[$name]) ? $_FILES[$name] : null;
    }

    public function getServer($name, $default = null) {
    }

    public function getEnv($name, $default = null) {
    }

    public function setPost($name, $value) {
        $this->setMethod('Post');
        $_POST[$name] = $value;
        return $this;
    }

    public function setQuery($name, $value) {
        $_GET[$name] = $value;
        return $this;
    }

    public function setCookie($name, $value) {
        $_COOKIE[$name] = $value;
        return $this;
    }

    public function setServer($name, $value) {
        $_SERVER[$name] = $value;
        return $this;
    }
}


/**
 * \YafUnit\Request\Simple 通过模块/控制器/方法等模拟一个Request对象
 * \Yaf\Request\Simple final不可被继承
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-18
 */
final class Simple extends \Yaf\Request_Abstract {

    /**
     * 初始化
     * @param string $method     方法POST GET PUT...
     * @param string $module     模块
     * @param string $controller 控制器
     * @param string $action     方法
     * @param array  $params     参数
     */
    public function __construct($method, $module, $controller, $action, $params = array()) {
        $this->method     = $method;
        $this->module     = $module;
        $this->controller = $controller;
        $this->action     = $action;
        $this->params     = $params;
        // 初始化一个新的测试请求时，清空模板
        \YafUnit\View::getInstance()->clear();
    }

    public function getQuery($name = null) {
        if (is_null($name)) return $_GET;
        return isset($_GET[$name]) ? $_GET[$name] : null;
    }

    public function getPost($name = null) {
        if (is_null($name)) return $_POST;
        return isset($_POST[$name]) ? $_POST[$name] : null;
    }

    public function getCookie($name = null) {
        if ( is_null($name) ) return $_COOKIE;
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }

    public function getFiles($name = null) {
        if (is_null($name)) return $_FILES;
        return isset($_FILES[$name]) ? $_FILES[$name] : null;
    }

    public function getServer($name, $default = null) {
    }

    public function getEnv($name, $default = null) {
    }

    public function setPost($name, $value) {
        $_POST[$name] = $value;
    }

    public function setQuery($name, $value) {
        $_GET[$name] = $value;
    }

    public function setCookie($name, $value) {
        $_COOKIE[$name] = $value;
    }

    public function setServer($name, $value) {
        $_SERVER[$name] = $value;
    }
}

namespace YafUnit;

/**
 * \YafUnit\View 通过模拟一个无法渲染无法读取模板的视图引擎获取视图中变量
 * \Core\View 继承核心视图类 > 子类\Yaf\View\Simple
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-04-18
 */
final class View extends \Core\View {

    protected static $_instance = null;

    /**
     * 初始化一个单例对象，不需要模板路径以及任何渲染参数，随意设置一个模板路径
     * @return View object
     */
    public static function getInstance() {
        if ( ! self::$_instance) {
            self::$_instance = new self( ROOT_PATH, array() );
        }
        return self::$_instance;
    }


    /**
     * 渲染为空
     * @param  string $view_path 视图路径
     * @param  array  $tpl_vars  变量
     * @return false
     */
    public function render( $view_path, $tpl_vars = null ) {
        return false;
    }


    /**
     * 读取模板为空
     * @param  string $view_path 视图路径
     * @param  array  $tpl_vars  变量
     * @return false
     */
    public function display( $view_path, $tpl_vars = null) {
        return false;
    }
}