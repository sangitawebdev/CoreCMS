<?php
class Router {
    protected $routes = [];

    // Add route with optional regex
    public function add($uri, $controller, $method = 'index') {
        // Convert slashes to regex-friendly
        $this->routes[$uri] = ['controller' => $controller, 'method' => $method];
    }

public function dispatch($uri) {
    $uri = trim(parse_url($uri, PHP_URL_PATH), '/');

    // Remove project folder name if exists (CoreCMS)
    $uri = preg_replace('#^CoreCMS/?#', '', $uri);

    foreach ($this->routes as $route => $info) {
        if (preg_match('#^' . $route . '$#', $uri, $matches)) {
            array_shift($matches); // remove full match
            $controllerName = "App\\Controllers\\" . $info['controller'];
            $method = $info['method'];

            $controller = new $controllerName();
            call_user_func_array([$controller, $method], $matches);
            return;
        }
    }

    echo "404 Not Found: " . htmlspecialchars($uri);
}

}
