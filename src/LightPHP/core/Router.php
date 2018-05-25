<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 12/06/2016
 * Time: 19:55.
 */

namespace LightPHP\Core;

use LightPHP\Core;
use LightPHP\Exceptions\InvalidRouteCollectionException;

class Router
{
    protected $routes = [];
    protected $methods = [];
    protected $allowedMethods = [];

    protected $base = '';

    public function __construct($base = null)
    {
        $_SERVER['HTTP_HOST'] = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '/';

        $this->base = is_null($base) ? $_SERVER['HTTP_HOST'] : $base;
    }

    /**
     * @param $route string
     * @param $method string
     */
    public function add($methods, $name, $route, $callable)
    {
        if (array_key_exists($name, $this->routes) || array_key_exists($name, $this->methods) || array_key_exists($name, $this->allowedMethods)) {
            throw new \Exception('Name already in use', 500);
        }

        $this->routes[$name] = $route;
        $this->methods[$name] = $callable;
        $this->allowedMethods[$name] = $methods;
    }

    public function addRoutes($routes)
    {
        if (!is_array($routes)) {
            throw new InvalidRouteCollectionException();
        }

        foreach ($routes as $route) {
            $this->add($route['method'], $route['name'], $route['route'], $route['callable']);
        }
    }

    public function dispatch()
    {
        $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

        $request = new Request($uri, $_SERVER['REQUEST_METHOD'], getallheaders(), '');
        Core::setRequest($request);

        foreach ($this->routes as $key => $route) {
            $pattern = '@^'.preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', preg_quote($route)).'$@D';
            $matches = [];
            // check if the current request matches the expression
            if (preg_match($pattern, $uri, $matches)) {
                if (is_array($this->methods[$key]) || $this->methods[$key] instanceof Traversable) {
                    $controller = $this->methods[$key]['controller'];

                    if (class_exists($this->methods[$key]['controller'])) {
                        $controller = new $controller();
                        $action = $this->methods[$key]['action'].'Action';

                        if (method_exists($controller, $action)) {
                            $controller->setView($this->methods[$key]['view']);

                            return $controller->$action();
                        }
                    }
                }
            }
        }

        // required 404 view
        $controller = $this->methods['error']['controller'];
        $controller = new $controller();
        $controller->setView($this->methods['error']['view']);
        $action = $this->methods['error']['action'].'Action';

        return $controller->$action();
    }

    public function getBase()
    {
        return $this->base;
    }

    /**
     * @return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * @return array
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @return array
     */
    public function getAllowedMethods()
    {
        return $this->allowedMethods;
    }
}
