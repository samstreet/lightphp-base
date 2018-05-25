<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 07/01/2017
 * Time: 16:42.
 */

namespace LightPHP\Core;

/**
 * Class core
 * Handles all core logic.
 */
class Core
{
    protected static $_serviceLocator = null;
    protected static $_layout = null;
    protected static $_config = [];
    protected static $_request = null;

    /**
     * Return the default config.
     *
     * @return mixed
     */
    public static function getConfig()
    {
        return self::$_config;
    }

    public static function setConfig($config)
    {
        return self::$_config = $config;
    }

    public static function setServiceLocator($services)
    {
        $registry = new ServiceRegistry();

        foreach ($services as $key => $service) {
            $registry->set($key, new $service());
        }

        self::$_serviceLocator = new \LightPHP\Core\ServiceLocator($registry);
    }

    public static function getServiceLocator()
    {
        return self::$_serviceLocator;
    }

    public function getCoreService()
    {
        return $this->getServiceLocator()->get('core_service');
    }

    /**
     * @return null
     */
    public static function getRequest()
    {
        return self::$_request;
    }

    /**
     * @param null $request
     */
    public static function setRequest($request)
    {
        self::$_request = $request;
    }

    /**
     * @return null
     */
    public static function getLayout()
    {
        return self::$_layout;
    }

    /**
     * @param null $layout
     */
    public static function setLayout($layout)
    {
        self::$_layout = $layout;
    }
}
