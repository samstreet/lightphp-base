<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 17/02/2017
 * Time: 17:39
 */

namespace Test\Core;


use LightPHP\Core\Router;
use LightPHP\Exceptions\InvalidRouteCollectionException;

class RouterTest extends \PHPUnit_Framework_TestCase
{

    public $router;

    public function testConstruct(){
        $this->router = new Router();
        $this->assertEquals("/", $this->router->getBase());

        $this->router = new Router();
        $this->assertNotEquals("/home", $this->router->getBase());
    }

    public function testAddMethod(){
        $this->router = new Router();

        $callable =  [
                    'controller' => 'Application\Controller\IndexController',
                    'namespace' => 'Application\Controller',
                    'action' => 'index',
                    'view' => 'index/index'
                ];

        $this->router->add(["GET"], "test", "/", $callable);
        $this->assertEquals(1, count($this->router->getRoutes()));

        $this->router->add(["GET"], "test1", "/test", $callable);
        $this->assertEquals(2, count($this->router->getRoutes()));

        $this->router->add(["GET"], "test2", "/test2", $callable);
        $this->assertEquals(3, count($this->router->getRoutes()));

        // need to test exception
        $this->setExpectedException(\Exception::class);
        $this->router->add(["GET"], "test2", "/test2", $callable);
    }

    public function testAddRoutesMethod(){
        $this->router = new Router();

        $routes = [
            [
                'method' => ['GET'],
                'name' => 'index',
                'route' => '/',
                'callable' => [
                    'controller' => 'Application\Controller\IndexController',
                    'namespace' => 'Application\Controller',
                    'action' => 'index',
                    'view' => 'index/index'
                ]
            ],
            [
                'method' => ['GET'],
                'name' => 'error',
                'route' => '/404',
                'callable' => [
                    'controller' => 'Application\Controller\ErrorController',
                    'namespace' => 'Application\Controller',
                    'action' => 'error',
                    'view' => 'error/404'
                ]
            ]
        ];

        $this->router->addRoutes($routes);
        $this->assertEquals(2, count($this->router->getRoutes()));

    }



}