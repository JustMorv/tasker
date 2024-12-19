<?php

// Включаем отображение ошибок (для отладки)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Роутинг
$uri = trim($_SERVER['REQUEST_URI'], '/');
$segments = explode('/', $uri);

// Получаем имя контроллера и метод
$controllerName = !empty($segments[0]) ? ucfirst($segments[0]) . 'Controller' : 'SiteController';
$actionName = !empty($segments[1]) ? $segments[1] : 'index';

// Подключаем файл контроллера
$controllerPath = 'controllers/' . $controllerName . '.php';
if (file_exists($controllerPath)) {
    require_once $controllerPath;
} else {
    die("Контроллер <b>$controllerName</b> не найден.");
}

// Создаем экземпляр контроллера
$controller = new $controllerName();
if (method_exists($controller, $actionName)) {
    $controller->$actionName();
} else {
    die("Метод <b>$actionName</b> не найден в контроллере <b>$controllerName</b>.");
}
