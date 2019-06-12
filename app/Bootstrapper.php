<?php

namespace App;


use App\Interfaces\IRenderer;
use App\Interfaces\IRouter;
use App\Adapters\SlimRouter;
use App\Adapters\TwigRenderer;
use App\Interfaces\IStringHandler;
use DI\Container;
use DI\ContainerBuilder;

/**
 *Returns instances of app components. They must be anything, that implements required interfaces.
 */

class Bootstrapper
{
    /**
     * @var Bootstrapper
     */
    private static $instance;
    /**
     * @var Container
     */
    private $container;

    public static function getRoutingEngine(): IRouter
    {

        return self::getInstance()->container->get('router');
    }

    public static function getRenderer(): IRenderer
    {
        return self::getInstance()->container->get('renderer');
    }

    public static function getProcessor(): IStringHandler
    {
        return self::getInstance()->container->get('processor');
    }

    private static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new Bootstrapper();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(__DIR__.'/config.php');
        $this->container = $builder->build();
    }

    private function __clone() {}
}