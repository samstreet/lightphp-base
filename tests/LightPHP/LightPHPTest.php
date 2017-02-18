<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 17/02/2017
 * Time: 17:27
 */

namespace Test\LightPHP;


use LightPHP\Exceptions\InvalidConfigurationFileException;
use LightPHP\LightPHP;

class LightPHPTest extends \PHPUnit_Framework_TestCase
{

    protected $config = [
        "layout"    => __DIR__ . "/../Application/Layout/default.phtml",
        "error"     =>  __DIR__ . "/../Application/Layout/default.phtml",
        "view_root" => __DIR__ . "/../Application/View",
        'routes' => [
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
        ],
        'services' => [
            'core_service' => 'LightPHP\Services\CoreService'
        ],
        'database' => [

        ]
    ];

    public function testConstruct()
    {

        $this->setExpectedException(\Exception::class);
        $app = new LightPHP("errors");

        $this->setExpectedException(\Exception::class);
        $app = new LightPHP(["invalid"]);

    }

    public function testValidateConfig(){
        $this->setExpectedException(\Exception::class);
        $app = new LightPHP($this->config);
    }

}