<?php

namespace App\Adapters;


use App\Interfaces\IRenderer;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class TwigRenderer implements IRenderer
{
    private $templateEngine;

    public function render(string $template, array $args = null)
    {
        $this->templateEngine->display($template, $args);
    }

    public function __construct()
    {
        $loader = new FilesystemLoader('resources/templates');
        $this->templateEngine = new Environment($loader);
    }
}