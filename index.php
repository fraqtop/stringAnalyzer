<?php
require 'vendor/autoload.php';

use App\Bootstrapper;


$router = Bootstrapper::getRoutingEngine();

$router->get('/', 'StringProcessingController#getIndexPage');
$router->post('/process', 'StringProcessingController#process');

$router->execute();