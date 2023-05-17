<?php

/** Base URL with trailing slash / at the end */
const BASE_URL = 'https://fast-framework.test/';

/** App Debug */
const APP_DEBUG = 1;
const LOGGING = 1;

/** Database Connection */
const DB_HOST = 'localhost';
const DB_PORT = 3306;
const DB_DATABASE = 'leopard';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';

/** Session Settings */
const SESSION_SECURE = false;
const SESSION_HTTP_ONLY = true;
const SESSION_USE_ONLY_COOKIES = true;

/** App Debug */
if (APP_DEBUG) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 'Off');
}

if (LOGGING) {
    ini_set('log_errors', 1);
    ini_set('error_log', BASE_PATH . 'storage/logs/debug-' . date('Y-m-d') . '.log');
} else {
    ini_set('log_errors', 0);
}
