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

    public function __construct()
    {
        $this->templateEngine = Bootstrapper::getRenderer();
    }

    public static function getInstance()
    {
        return new StringProcessingController(new PalindromeFinder());
    }
}