<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 08/02/2017
 * Time: 21:23
 */

namespace LightPHP\Core;


use LightPHP\Interfaces\RequestInterface;

class Request implements RequestInterface
{
    CONST M_GET     = "GET";
    CONST M_POST    = "POST";
    CONST M_DELETE  = "DELETE";

    protected $_method = self::M_GET;
    protected $_headers = [];
    protected $_body = null;
    protected $_uri = null;
    protected $_controller = null;

    function __construct($uri, $method, $headers, $body)
    {
        if(!defined('static::M_' . $method))
            throw new \Exception("Invalid method supplied");

        $this->_method = $method;
        $this->_headers = $headers;
        $this->_uri = $uri;

        return $this;

    }

    public function getHeaders()
    {
        return $this->_headers;
    }

    public function setController($controller){
        return $this->_controller = $controller;
    }
}