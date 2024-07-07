<?php

define('DIR', __DIR__);

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

use Controller\ControllerNews;

$controller = new ControllerNews();
$requestUri = $_SERVER['REQUEST_URI'];
$path = strtok($requestUri, '?');

if ($path === '/' || $path === '') {
    include_once 'View/Start.php';
    exit; 
}

if ($path === '/news/') {
    $page = 1;
    $controller->actionList($page);
} elseif (preg_match('/^\/news\/page-([0-9]+)\/?$/', $path, $matches)) {
    $page = intval($matches[1]);
    $controller->actionList($page);
} elseif (preg_match('/^\/news\/([0-9]+)\/?$/', $path, $matches)) {
    $id = intval($matches[1]);
    $controller->actionDetail($id);
} else {
    http_response_code(404);
    echo 'Страница не найдена';
    exit;
}
