<?php
session_start();

require_once __DIR__ . '/../src/Controllers/AuthController.php';
require_once __DIR__ . '/../src/Controllers/TaskController.php';

if (empty($_SESSION['csrf_token'])) 
{
    $_SESSION['csrf_token'] = md5(uniqid(mt_rand(), true));
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/' || $uri === '/login') 
{
    $controller = new AuthController();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {

        $controller->login();

    } else 
    {
        $controller->showLogin();
    }

    exit;
}

if ($uri === '/tasks') 
{
    $controller = new TaskController();

    $controller->index();

    exit;
}

if ($uri === '/tasks/create') 
{
    $controller = new TaskController();

    $controller->create();
    
    exit;
}

if ($uri === '/tasks/update') {

    $controller = new TaskController();
    
    $controller->update();
    
    exit;
}

if ($uri === '/tasks/delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $controller = new TaskController();
    
    $controller->delete();
    
    exit;
}

if ($uri === '/logout') {

    $controller = new AuthController();

    $controller->logout();

    exit;
}