<?php

namespace App;


class Boot
{
    private Router $router;

    public function __construct()
    {
        error_reporting(E_ERROR | E_PARSE);
        
        Bone::setGlobalDC(new DependencyContainer());
        $this->router = new Router();
        $this->router->registerRoutes();
    }


    public function run(): void
    {
        $this->router->dispatch();
    }
}
