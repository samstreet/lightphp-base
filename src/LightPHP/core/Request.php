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

    function __construct($method, $headers)
    {
        if(!defined('static::M_' . $method))
            throw new \Exception("Invalid method supplied");

        $this->_method = $method;
        $this->_headers = $headers;

        return $this;

    }

    public function getHeaders()
    {
        // TODO: Implement getHeaders() method.
    }

    public function getQuery()
    {
        // TODO: Implement getQuery() method.
    }

    public function getPost()
    {
        // TODO: Implement getPost() method.
    }
}