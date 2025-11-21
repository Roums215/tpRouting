<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../Controllers/Auth.php';
include '../Controllers/Base.php';


$url = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
if ($url === '' || $url === false) {
    $url = '/';
}


if (!preg_match('#^/[a-zA-Z0-9/_-]$#', $url)) {
    die('url pas bonne');
}

$routesFile = __DIR__ . '/../routes.yml';



$routes = yaml_parse_file($routesFile);



if (!isset($routes[$url])) {
    die('Fais demi tour');
}


$controllerClass = $routes[$url]['controller'] ?? null;
$action          = $routes[$url]['action'] ?? null;




$controller = new $controllerClass();



$controller->$action();
