<?php
/**
 * @file     Router.class.php
 * @author   Estéban DESESSARD
 * @brief
 * @details
 * @date     14/12/2024
 * @version  0.0
 */

class Router {
    private static ?Router $instance = null;
    private array $routes = [];

    private function __construct()
    {
    }

    public static function getInstance(): Router
    {
        if (is_null(self::$instance)) {
            self::$instance = new Router();
        }
        return self::$instance;
    }

    private function addRoute(string $method, string $url, callable $target): void
    {
        $this->routes[$method][BASE_URI . $url] = $target;
    }

    public function get(string $url, callable $target): void
    {
        $this->addRoute('GET', $url, $target);
    }

    public function post(string $url, callable $target): void
    {
        $this->addRoute('POST', $url, $target);
    }

    public function delete(string $url, callable $target): void
    {
        $this->addRoute('DELETE', $url, $target);
    }

    public function matchRoute(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'];

        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $routeUrl => $target) {

                $pattern = preg_replace('/\/:([^\/]+)/', '/(?P<$1>[^/]+)', $routeUrl);
                if (preg_match('#^' . $pattern . '$#', $url, $matches)) {
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    call_user_func_array($target, $params);
                    return;
                }
            }
        }
        throw new Exception('Route ' . $url . ' (' . $method . ')' . ' not found');
    }

    public function __wakeup(): void
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    private function __clone(): void
    {
    }
}
