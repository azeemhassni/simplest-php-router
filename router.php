<?php

/**
 * Holds the registered routes
 *
 * @var array $routes
 */
$routes = [];

/**
 * Register a new route
 *
 * @param $action string
 * @param \Closure $callback Called when current URL matches provided action
 */
function route($action, Closure $callback)
{
    global $routes;
    $action = trim($action, '/');
    $routes[$action] = $callback;
}

/**
 * Dispatch the router
 *
 * @param $action string
 */
function dispatch($action)
{
    global $routes;
    $action = trim($action, '/');

    $callback = null;
    $params = [];
    foreach ($routes as $route => $handler) {
        if(preg_match("%^{$route}$%", $action, $matches) === 1) {
            $callback = $handler;
            unset($matches[0]);
            $params = $matches;
            break;
        }
    }

    if(!$callback || !is_callable($callback)) {
        http_response_code(404);
        echo "404 - Not found";
        exit;
    }

    echo call_user_func($callback, ...$params);
}
