<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Container.php';

use App\Application\Controllers\UserController;
use Core\Router;
use Core\Container;

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '/';

error_log("Method: $method, Path: $path"); // Registro de depuración
error_log("Request URI: " . $_SERVER['REQUEST_URI']);
error_log("Path Info: " . ($_SERVER['PATH_INFO'] ?? 'N/A'));

$container = new Container();

$container->set('UserController', function () {
    return new UserController();
});

$router = new Router();

$router->add('POST', '/register', function () use ($container) {
    $data = json_decode(file_get_contents('php://input'), true);
    $controller = $container->get('UserController');
    echo json_encode($controller->register($data['username'], $data['password']));
});

$router->add('POST', '/login', function () use ($container) {
    $data = json_decode(file_get_contents('php://input'), true);
    $controller = $container->get('UserController');
    echo json_encode($controller->login($data['username'], $data['password']));
});

$router->add('GET', '/user', function () use ($container) {
    $token = getallheaders()['Authorization'] ?? '';
    $controller = $container->get('UserController');
    echo json_encode($controller->getUser(str_replace('Bearer ', '', $token)));
});

$router->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
