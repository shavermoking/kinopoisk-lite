<?php

namespace App\Router;

class Router
{
    public function dispatch(string $uri): void
    {
        $routes = $this->getRoutes();

        $routes[$uri]();
    }

    public function getRoutes(): array
    {
        return require_once APP_PATH . '/config/routes.php';
    }
}