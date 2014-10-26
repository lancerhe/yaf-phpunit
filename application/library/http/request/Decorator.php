<?php
/**
 * 抽象HTTP装饰类
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-03-23
 */
abstract class Http_Request_Decorator extends Http_Request_Abstract {

    /**
     * 继承Http_Request_Abstract的Request实例对象
     */
    protected $_http_request;

    /**
     * 初始化装饰器，装饰对象必须继承Http_Request_Abstract
     */
    public function __construct (Http_Request_Abstract $http_request) {
        $this->_http_request = $http_request;
    }


    /**
     * 获取CURL Handler
     * @return resource
     */
    public function getHandler() {
        return $this->_http_request->getHandler();
    }


    /**
     * 获取response信息
     * @return mixed
     */
    public function getResponse() {
        return $this->_http_request->getResponse();
    }


    /**
     * 设置response信息
     * @param mixed $response
     */
    public function setResponse($response) {
        $this->_http_request->setResponse($response);
    }


    /**
     * 获取request信息
     * @return mixed
     */
    public function getRequest() {
        return $this->_http_request->getRequest();
    }


    /**
     * 设置request信息
     * @param mixed $request
     */
    public function setRequest($request) {
        $this->_http_request->setRequest($request);
    }


    /**
     * 发送HTTP请求
     * @param  array   $post  POST数据，null表示无post即GET请求
     * @param  string  $url   请求的URL地址，可以通过包装类指定一个URL
     * @return void
     */
    public function sendRequest($url = null, $post = null) {
        return $this->_http_request->sendRequest($url, $post);
    }


    /**
     * 解析HTTP请求返回的response数据
     * @return mixed
     */
    public function parseResponse() {
        return $this->_http_request->parseResponse();
    }
}