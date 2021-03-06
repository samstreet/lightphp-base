<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 10/02/2017
 * Time: 17:20
 */

namespace LightPHP\Core;


class Layout
{
    private $content;
    private $render;

    function __construct($template, $content = null)
    {
        try {
            $file = $template;
            if (file_exists($file)) {
                $this->content = $content;
                $this->render = $file;
            } else {
                throw new \Exception("Invalid Layout");
            }
        }
        catch (\Exception $e) {
            throw $e;
        }

    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    public function __destruct()
    {
        extract((array) $this->content);
        include($this->render);
    }


}