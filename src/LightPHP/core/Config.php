<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 18/02/2017
 * Time: 20:19.
 */

namespace LightPHP\Core;

class Config
{
    protected $routes = [];
    protected $services = [];
    protected $layout;
    protected $data = [];

    public function __construct($config = [])
    {
        try {
            foreach ($config as $key => $value) {
                if ($key == 'routes') {
                    $this->routes['name'] = $value;
                } elseif ($key == 'services') {
                    $this->services[] = $value;
                } elseif ($key == 'layout') {
                    $this->layout = new Layout($value);
                } else {
                    $this->data[$key] = $value;
                }
            }
        } catch (\Exception $e) {
            throw $e;
        }

        return $this;
    }

    public function addRoute($route)
    {
    }

    public function addService($service)
    {
    }

    /**
     * @return mixed
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @return mixed
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @return mixed
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @return array
     */
    public function getData($key)
    {
        return $this->data[$key];
    }
}
