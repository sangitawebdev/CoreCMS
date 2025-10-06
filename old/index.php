<?php
// index.php

if (!file_exists(__DIR__ . '/config/config.php')) {
    header("Location: /CoreCMS/install/");
    exit;
}

require __DIR__ . '/app/Core/Bootstrap.php';
require __DIR__ . '/app/Core/Router.php';

// Autoloader
spl_autoload_register(function ($class) {
    $class = str_replace("\\", "/", $class);
    $path = __DIR__ . '/app/' . str_replace("App/", "", $class) . '.php';
    if (file_exists($path)) {
        require $path;
    }
});

// Init
Bootstrap::init();

// Routes
$router = new Router();
$router->add('', 'HomeController', 'index');
$router->add('login', 'AuthController', 'login');
$router->add('logout', 'AuthController', 'logout');
$router->add('dashboard', 'AuthController', 'dashboard');

$router->dispatch($_SERVER['REQUEST_URI']);
