<?php
/**
 * 用户信息服务
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-06-23
 */
namespace Service\User;

class Info {

    public function requestAccountBalance() {
        $http_request = new \Http_Request_Curl();
        $http_request = new \Http_Request_Decorator_SimpleCrypt($http_request);
        $http_request->sendRequest("http://192.168.8.111:8080/login/parse", array('action' => 'login'));
        return $http_request->parseResponse();
    }
}