<?php
// app/Core/Router.php

class Router {
    protected $routes = [];

    public function add($uri, $controller, $method = 'index') {
        $this->routes[$uri] = ['controller' => $controller, 'method' => $method];
    }

    public function dispatch($uri) {
        $uri = trim(parse_url($uri, PHP_URL_PATH), '/');

        // Remove project folder name if exists (CoreCMS)
        $uri = preg_replace('#^CoreCMS/?#', '', $uri);

        if (isset($this->routes[$uri])) {
            $controllerName = "App\\Controllers\\" . $this->routes[$uri]['controller'];
            $method = $this->routes[$uri]['method'];

            $controller = new $controllerName();
            call_user_func([$controller, $method]);
        } else {
            echo "404 Not Found: " . htmlspecialchars($uri);
        }
    }
}
