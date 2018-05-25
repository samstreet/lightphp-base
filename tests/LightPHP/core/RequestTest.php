<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 17/02/2017
 * Time: 18:01.
 */

namespace Test\Core;

use LightPHP\Core\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $this->setExpectedException(\Exception::class);
        $req = new Request();

        $this->setExpectedException(\Exception::class);
        $req = new Request('/', 'TEST', [], '');
    }

    public function testGetHeaders()
    {
        $req = new Request('/', 'GET', [], '');
        $this->assertTrue(is_array($req->getHeaders()));
    }
}
