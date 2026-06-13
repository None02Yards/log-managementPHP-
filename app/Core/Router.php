<?php

namespace App\Core;

/**
 * Router - Handles URL routing in a clean, scalable way
 */
class Router
{
    private array $routes = [];
    private array $params = [];

    public function register(string $method, string $route, string $controller, string $action): self
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'route' => trim($route, '/'),
            'controller' => $controller,
            'action' => $action,
        ];

        return $this;
    }

    public function get(string $route, string $controller, string $action): self
    {
        return $this->register('GET', $route, $controller, $action);
    }

    public function post(string $route, string $controller, string $action): self
    {
        return $this->register('POST', $route, $controller, $action);
    }

    public function put(string $route, string $controller, string $action): self
    {
        return $this->register('PUT', $route, $controller, $action);
    }

    public function delete(string $route, string $controller, string $action): self
    {
        return $this->register('DELETE', $route, $controller, $action);
    }

    public function dispatch()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        // Normalize URI safely (no hardcoded project path)
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        if ($scriptName !== '/' && $scriptName !== '\\') {
            $requestUri = str_replace($scriptName, '', $requestUri);
        }

        $requestUri = trim($requestUri, '/');

        // Normalize root route
        if ($requestUri === '') {
            $requestUri = '/';
        }


            


        foreach ($this->routes as $route) {

            $pattern = $this->convertToRegex($route['route']);

            if (
                $route['method'] === $requestMethod &&
                preg_match($pattern, $requestUri, $matches)
            ) {
                $this->params = $this->extractParams($matches);
                return $this->executeRoute($route);
            }
        }

        return $this->notFound($requestUri, $requestMethod);
    }

    private function convertToRegex(string $route): string
    {
        $route = trim($route, '/');

        // convert {id} → named regex group
        $route = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $route);

        // allow root route "/"
        if ($route === '') {
            $route = '/';
        }

        return '#^' . $route . '$#';
    }

    private function extractParams(array $matches): array
    {
        $params = [];

        foreach ($matches as $key => $value) {
            if (is_string($key)) {
                $params[$key] = $value;
            }
        }

        // fallback positional params (optional compatibility)
        if (empty($params)) {
            $params = array_values(array_slice($matches, 1));
        }

        return $params;
    }

    private function executeRoute(array $route)
    {
        $controllerClass = 'App\\Controllers\\' . $route['controller'];
        $actionMethod = $route['action'];

        if (!class_exists($controllerClass)) {
            return $this->debugError("Controller not found: $controllerClass");
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $actionMethod)) {
            return $this->debugError("Method not found: $actionMethod in $controllerClass");
        }

        return call_user_func_array([$controller, $actionMethod], $this->params);
    }

    private function notFound(string $uri, string $method)
    {
        http_response_code(404);

        error_log("[ROUTER 404] $method $uri");

        echo "404 - Route not found";
        return false;
    }

    private function debugError(string $message)
    {
        http_response_code(500);

        error_log("[ROUTER ERROR] " . $message);

        echo "500 - Internal routing error";
        return false;
    }
}