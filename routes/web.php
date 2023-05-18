<?php

/**
 * ------------------------------------------------------------------------------
 * Web Routes
 * ------------------------------------------------------------------------------
 * Here is where you can register web routes for your application
 * ------------------------------------------------------------------------------
 **/
/** Before Route Middlewares */
$router->before('GET|POST|PUT|DELETE', '/.*', '\App\Core\Session@startSession');
$router->before('GET|POST|PUT|DELETE', '/admin/login', '\App\Middleware\AuthMiddleware@adminTrue');
$router->before('GET|POST|PUT|DELETE', '/admin', '\App\Middleware\AuthMiddleware@adminFalse');
$router->before('GET|POST|PUT|DELETE', '/admin/(?!login)(.*)', '\App\Middleware\AuthMiddleware@adminFalse');
/** Admin Panel Routes */
$router->mount('/admin', function () use ($router) {
    $router->get('/', '\App\Controllers\TestController@admin');
    $router->get('/login', '\App\Controllers\TestController@adminlogin');
    $router->get('/users', '\App\Controllers\TestController@adminUsers');
});

$router->get('/', '\App\Controllers\TestController@test');

$router->set404(function () {
    header('HTTP/1.1 404 Not Found');
});
