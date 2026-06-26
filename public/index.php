<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Seeder;

Seeder::run();

require_once __DIR__ . '/../routes/web.php';
