<?php

use App\Core\Router;
use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\CustomerController;

$router = new Router();

$router->get('/', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'loginStore']);
$router->get('/logout', [AuthController::class, 'logout']);
$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'registerStore']);

$router->get('/admin', [AdminController::class, 'dashboard']);
$router->get('/admin/customers', [AdminController::class, 'customers']);
$router->get('/admin/transactions', [AdminController::class, 'transactions']);

$router->get('/dashboard', [CustomerController::class, 'dashboard']);
$router->get('/transactions', [CustomerController::class, 'transactions']);
$router->post('/deposit', [CustomerController::class, 'deposit']);
$router->post('/withdraw', [CustomerController::class, 'withdraw']);
$router->post('/transfer', [CustomerController::class, 'transfer']);

$router->resolve();
