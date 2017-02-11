<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 10/02/2017
 * Time: 20:38
 */

namespace LightPHP\MVC\Controller;

use LightPHP\Core\ControllerBase;

class ErrorController extends ControllerBase
{
    public function errorAction(){
        return $this->view;
    }
}