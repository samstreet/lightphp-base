<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 10/02/2017
 * Time: 16:58
 */

namespace LightPHP\MVC\Controller;


use LightPHP\Core\ControllerBase;

class TestController extends ControllerBase
{

    public function indexAction(){
        return $this->view;
    }

    public function testAction(){
        return $this->view;
    }

}