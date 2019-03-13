<?php

namespace App\Adapters;


use App\Controllers\Controller;
use App\Interfaces\IRouter;
use Slim\App;


class SlimRouter implements IRouter
{
    /**
     * @var App
     */
    private $engine;
    private $controllerRootNamespace;
    private $pathDelimiter;

    public function get($path, $actionName)
    {
        $callableArgs = self::getCallbackArgs($actionName);
        $result = $this->engine->get($path, $callableArgs);
        return $result;
    }

    public function post($path, $actionName)
    {
        $callableArgs = self::getCallbackArgs($actionName);
        $result = $this->engine->post($path, $callableArgs);
        return $result;
    }
    private function getCallbackArgs($path)
    {
        $args = explode($this->pathDelimiter, $path);
        if (count($args) === 2) {
            $args[0] = Controller::getInstance();
        }
        return $args;
    }
    public function execute()
    {
        $this->engine->run();
    }

    public function __construct($newPathDelimiter, $newControllerNamespace)
    {
        $this->engine = new App();
        $this->pathDelimiter = $newPathDelimiter;
        $this->controllerRootNamespace = $newControllerNamespace;
    }
}