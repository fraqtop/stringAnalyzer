<?php

namespace App;


use App\Interfaces\IRenderer;
use App\Interfaces\IRouter;
use App\Adapters\SlimRouter;
use App\Adapters\TwigRenderer;

/**
 *Returns instances of app components. They must be anything, that implements required interfaces.
 */

class Bootstrapper
{
    public static function getRoutingEngine(): IRouter
    {
        return new SlimRouter('#', 'App\\Controllers\\');
    }

    public static function getRenderer(): IRenderer
    {
        return new TwigRenderer();
    }
}