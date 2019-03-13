<?php

namespace App\Interfaces;


interface IStringHandler
{
    public function process(string $string): string ;
    public function getSubmitLabel(): string ;
}