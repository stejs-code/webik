<?php

namespace App;


class Boot
{
    private Router $router;

    public function __construct()
    {
        Bone::setGlobalDC(new DependencyContainer());
        $this->router = new Router();
        $this->router->registerRoutes();
    }


    public function run(): void
    {
        $this->router->dispatch();
    }
}
