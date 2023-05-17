<?php

/**
 * ------------------------------------------------------------------------------
 * Web Routes
 * ------------------------------------------------------------------------------
 * Here is where you can register web routes for your application
 * ------------------------------------------------------------------------------
 **/
$router->before('GET|POST|PUT|DELETE', '/.*', '\App\Core\Session@startSession');
$router->get('/', '\App\Controllers\TestController@test');

$router->set404(function () {
    header('HTTP/1.1 404 Not Found');
});
