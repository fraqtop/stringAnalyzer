<?php

namespace App\Controllers;


use App\Bootstrapper;
use App\Models\PalindromeFinder;

/**
 *Basic controller, that sets template engine and instance for string execution.
 */

abstract class Controller
{
    protected $templateEngine;

    public static function getInstance()
    {
        return new StringProcessingController(Bootstrapper::getProcessor());
    }

    public function __construct()
    {
        $this->templateEngine = Bootstrapper::getRenderer();
    }
}