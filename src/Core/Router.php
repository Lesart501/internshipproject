<?php

namespace App\Core;

use App\Lib\Exceptions\CustomException;

class Router
{
    private array $routes;
    private array $params;
    private string $controllerName;
    private string $action;

    public function __construct()
    {
        $routes = require SOURCE_DIR . 'Config/routes.php';
        foreach ($routes as $route => $params) {
            $route = "#^$route$#";
            $this->routes[$route] = $params;
        }
    }

    public function findRoute(string $url): void
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url)) {
                $this->params = $params;
                $this->controllerName = $params['controller'];
                $this->action = $params['action'];
                return;
            }
        }
        throw new CustomException(404);
    }
    
    public function getParams(): array
    {
        return $this->params;
    }
    
    public function getControllerName(): string
    {
        return $this->controllerName;
    }
    
    public function getAction(): string
    {
        return $this->action;
    }
}