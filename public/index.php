<?php

require_once __DIR__ . '/../vendor/autoload.php';

$routes = include __DIR__ . '/../config/routes.php';

$page = $_GET['page'] ?? 'form_input';

if (isset($routes[$page])) {
  [$class, $method] = $routes[$page];
  $controller = new $class();
  $controller->$method();
} else {
  echo "404 - Halaman tidak ditemukan.";
}
