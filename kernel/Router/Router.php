<?php

namespace App\Kernel\Router;

use App\Kernel\Controller\Controller;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\Request;
use App\Kernel\Session\Session;
use App\Kernel\View\View;
use JetBrains\PhpStorm\NoReturn;

class Router
{

    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function __construct(
        private readonly View    $view,
        private readonly Request $request,
        private readonly Redirect $redirect,
        private readonly Session $session,
    )
    {
        $this->initRoutes();
    }
    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if (!$route){
            $this->notFound();
        }

        if (is_array($route->getAction())){
            [$controller, $action] = $route->getAction();

            /** @var Controller $controller */
            $controller = new $controller;

            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);

            call_user_func([$controller, $action]);
        }else{
            call_user_func($route->getAction());
        }
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