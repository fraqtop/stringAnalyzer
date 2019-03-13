<?php

namespace App\Interfaces;


interface IRenderer
{
    public function render(string $template, array $args = null);
}