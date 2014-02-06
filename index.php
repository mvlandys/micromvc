<?php
    require 'vendor/autoload.php';
    require_once("Config/config.php");

    $router = new \Matheos\MicroMVC\Router();
    $router->dispatch();