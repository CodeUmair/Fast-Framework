<?php

/** Define Base Path */
define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR);

/** Require composer autoloader */
require BASE_PATH . 'vendor/autoload.php';
require BASE_PATH . 'config/config.php';

/** Create Router instance */
$router = new \Bramus\Router\Router();

/** Load Routes */
require BASE_PATH . 'routes/web.php';

/** Run it! */
$router->run();
