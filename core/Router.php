
<?php

class Router
{
    private $routes = [];

    // Register GET routes
    public function get($uri, $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    // Register POST routes
    public function post($uri, $action)
    {
        $this->routes['POST'][$uri] = $action;
    }

    // Match the incoming request
    public function dispatch($uri, $method)
    {
        $uri = parse_url($uri, PHP_URL_PATH);

        // Remove the project base path
        $basePath = '/student-management-system';

        if (strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        // Normalize the URL
        $uri = '/' . trim($uri, '/');

        if ($uri === '//') {
            $uri = '/';
        }

        // Check whether the route exists
        if (isset($this->routes[$method][$uri])) {

            $action = $this->routes[$method][$uri];

            // Execute controller method
            if (is_array($action)) {

                $controller = new $action[0]();

                $methodName = $action[1];

                $controller->$methodName();

            } else {

                // Execute closure
                call_user_func($action);
            }

        } else {

            http_response_code(404);

            echo "404 - Page Not Found";
        }
    }
}
