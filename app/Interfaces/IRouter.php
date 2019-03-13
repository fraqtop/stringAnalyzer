<?php
/**
 * Created by PhpStorm.
 * User: abreb
 * Date: 09.03.2019
 * Time: 18:52
 */

namespace App\Interfaces;


interface IRouter
{
    public function get(string $path, $callbackSignature);
    public function post(string $path, $callbackSignature);
}