<?php

use App\Core\Router;

$router = new Router();

$router->get('/', function () {
    echo "Welcome to Bank App";
});

$router->resolve();
