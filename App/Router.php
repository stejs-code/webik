<?php

namespace App;

use App\Module\HomePage;
use App\Module\StarryNight;
use App\Module\Task;
use App\Module\Canteen;
use App\Response\Response;


class Router extends Bone
{
    public array $routes = [];

    /**
     * @param $method string GET, POST, PUT, DELETE
     * @param $path string e.g. /user/login
     * @param $controller string
     * @return void
     */
    public function addRoute(string $method, string $path, string $controller): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller
        ];
    }

    /**
     * @param $method string
     * @param $path string
     * @return array|null // [ClassName, params]
     */
    public function getRoute(string $method, string $path): array|null
    {
        $params = [];

        foreach ($this->routes as $route) {
            if ($route['method'] == $method) {
                // Check for exact match
                if ($route['path'] == $path) {
                    return [
                        'controller' => $route['controller'],
                        'params' => $params
                    ];
                }

                // Check for routes with parameters
                $routeParts = explode('/', trim($route['path'], '/'));
                $pathParts = explode('/', trim($path, '/'));

                if (count($routeParts) == count($pathParts)) {
                    $match = true;

                    for ($i = 0; $i < count($routeParts); $i++) {
                        // Check if this part is a parameter
                        if (strpos($routeParts[$i], ':') === 0) {
                            // Extract parameter name without the colon
                            $paramName = substr($routeParts[$i], 1);
                            $params[$paramName] = $pathParts[$i];
                        } else if ($routeParts[$i] != $pathParts[$i]) {
                            $match = false;
                            break;
                        }
                    }

                    if ($match) {
                        return [
                            'controller' => $route['controller'],
                            'params' => $params
                        ];
                    }
                }
            }
        }

        return null;
    }

    /**
     * @param string $path
     * @param class-string $controller
     * @return void
     */
    private function get(string $path, string $controller): void
    {
        $this->addRoute('GET', $path, $controller);
    }

    private function post(string $path, string $controller): void
    {
        $this->addRoute('POST', $path, $controller);
    }

    public function registerRoutes(): void
    {
        $this->get('/', HomePage::class);
        $this->get('/task', Task::class);
        $this->get('/task/:urlPath', Task::class);
        $this->get('/canteen', Canteen::class);
        $this->get('/starry-night', StarryNight::class);
    }

    public function dispatch(): void
    {
        $path = $this->dc->request->getUri()->getPath();
        $route = $this->getRoute($this->dc->request->getMethod(), $path);
        $controllerClassName = $route['controller'] ?? null;
        $params = $route['params'] ?? [];

        foreach ($params as $key => $value) {
            $this->dc->parameters->$key = $value;
        }

        if ($controllerClassName) {
            $controller = new $controllerClassName($this->dc);

            if ($controller instanceof BaseController) {
                $controller->handle($this->dc->request);
            } else {
                (new Response())
                    ->status(500)
                    ->html("Unknown controller")
                    ->send();
            }
        } else {
            (new Error("Stránka nenalezena", 404))->render();
        }
    }
}
