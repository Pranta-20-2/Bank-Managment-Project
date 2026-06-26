<?php

namespace App\Core;

class Router
{
    /** @var array<string, array<string, callable|array{0: class-string, 1: string}>> */
    private array $routes = [];

    public function get(string $uri, callable|array $callback): void
    {
        $this->routes['GET'][$uri] = $callback;
    }

    public function post(string $uri, callable|array $callback): void
    {
        $this->routes['POST'][$uri] = $callback;
    }

    public function resolve()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $callback = $this->routes[$method][$uri] ?? null;

        if (!$callback) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        // If callback is array → Controller method
        if (is_array($callback)) {
            $controller = new $callback[0]();
            $method = $callback[1];
            call_user_func([$controller, $method]);
        } else {
            call_user_func($callback);
        }
    }
}