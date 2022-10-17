<?php
header('Access-Control-Allow-Origin: *');

require './vendor/autoload.php';

use Api\Services\ResponseService;

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('POST', '/create', ['Controller', 'create']);
    $r->addRoute('GET', '/{name:.*}', ['Controller', 'redirect']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
// var_dump($routeInfo);
switch ($routeInfo[0]){
    case FastRoute\Dispatcher::NOT_FOUND:
        $response_service = new ResponseService();
        $response_service->page404();
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        $response_service = new ResponseService();
        $response_service->header('400');
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        //Add url origin url to vars
        if ($httpMethod == 'POST') {
            $vars['url'] = $_POST['url'];
        }
        
        $class_path = 'Api\Controllers\\' . $handler[0];
        $class_method = $handler[1];
        $controller = new $class_path();
        // var_dump($vars, $routeInfo[2]['name']);
        // die();
        if (method_exists($class_path, $class_method)) {
            $controller->$class_method($vars);
        }        
        // ... call $handler with $vars
        break;
}