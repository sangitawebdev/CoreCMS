<?php
// index.php

if (!file_exists(__DIR__ . '/config/config.php')) {
    header("Location: /CoreCMS/install/");
    exit;
}
$config = require __DIR__ . '/config/config.php';

// Define constants
define('BASE_URL', $config['base_url']);

define('SITE_NAME', $config['app_name']);

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

$router = new Router();

// Homepage
$router->add('', 'SiteController', 'home');

// Auth
$router->add('login', 'AuthController', 'login');
$router->add('logout', 'AuthController', 'logout');
$router->add('dashboard', 'AuthController', 'dashboard');

// Admin Settings
$router->add('admin/settings', 'AdminController', 'settings');

// Menus
$router->add('admin/menu', 'MenuController', 'index');                       // List all menus
// $router->add('admin/menu/add', 'MenuController', 'store');
$router->add('admin/menu/edit/(\d+)', 'MenuController', 'edit');            // Edit menu
$router->add('admin/menu/delete/(\d+)', 'MenuController', 'delete');        // Delete menu
$router->add('admin/menu/add', 'MenuController', 'add');

$router->add('admin/menu/items/(\d+)', 'MenuController', 'menuItems'); 
$router->add('admin/menu/items/(\d+)/add', 'MenuController', 'menuItemAdd'); 
$router->add('admin/menu/items/(\d+)/edit/(\d+)', 'MenuController', 'menuItemEdit'); 
$router->add('admin/menu/items/(\d+)/delete/(\d+)', 'MenuController', 'menuItemDelete'); 

$router->dispatch($_SERVER['REQUEST_URI']);
