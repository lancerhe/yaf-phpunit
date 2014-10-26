<?php
/**
 * HTTP日志装饰类
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-03-23
 */
class Http_Request_Decorator_LoggerFile extends Http_Request_Decorator {

    protected $_output_file;

    public function __construct(Http_Request_Abstract $http_request) {
        parent::__construct($http_request);

        $this->_output_file = $this->setLogFilePath('/httprequest/' . date('Y-m-d') . '.log');
    }

    public function setLogFilePath($path) {
        return $this->_output_file = $path;
    }

    public function sendRequest($url = null, $post = null) {
        curl_setopt( $this->getHandler(), CURLINFO_HEADER_OUT, true);
        parent::sendRequest($url, $post);
        $this->_write($post);
    }

    public function parseResponse() {
        return parent::parseResponse();
    }

    protected function _write($post) {
        $request  = curl_getinfo( $this->getHandler() );
        $response = $this->getResponse();

        $output = 
            '>>>>>>>>>>>>' . PHP_EOL
            . '[time] => ' . date('Y-m-d H:i:s') . PHP_EOL
            . '[request_header]        => ' . rtrim($request['request_header'], "\r\n") . PHP_EOL
            . '[request_variable_body] => ' . (is_array($post) ? http_build_query($post) : $post) . PHP_EOL
            . '[request_original_body] => ' . $this->getRequest()->post . PHP_EOL
            . '[response_http_code]    => ' . $request['http_code'] . PHP_EOL
            . '[response_body]         => ' . $response . PHP_EOL;
        Util_Log::write($output, $this->_output_file);
    }
}