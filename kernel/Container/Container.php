<?php

namespace App\Kernel\Container;

use App\Kernel\Http\Request;
use App\Kernel\Router\Router;

readonly class Container
{
    public Request $request;

    public Router $router;

    public function __construct()
    {
        $this->registerServices();
    }

    private function registerServices(): void{
        $this->request = Request::createFromGlobals();
        $this->router = new Router();
    }
}