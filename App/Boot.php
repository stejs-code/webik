<?php

namespace App;

use GuzzleHttp\Psr7\ServerRequest;
use JetBrains\PhpStorm\NoReturn;


class Boot
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
        $this->router->registerRoutes();
    }


    public function run(): void
    {

        $request = ServerRequest::fromGlobals();

        $this->router->dispatch($request, new DependencyContainer());
    }

}