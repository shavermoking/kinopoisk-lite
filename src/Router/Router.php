<?php

namespace App\Router;

use JetBrains\PhpStorm\NoReturn;

class Router
{

    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function __construct()
    {
        $this->initRoutes();
    }
    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if (!$route){
            $this->notFound();
        }

        $route->getAction()();
    }

    #[NoReturn] private function notFound(): void
    {
        echo '404 Not Found';
        exit;
    }

    private function findRoute(string $uri, string $method): Route | false
    {
        if (!isset($this->routes[$method][$uri])){
            return false;
        }

        return $this->routes[$method][$uri];
    }

    public function initRoutes(): void
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route){
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    /**
     * @return Route[]
     */
    private function getRoutes(): array
    {
        return require APP_PATH . '/config/routes.php';
    }
}