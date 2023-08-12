<?php
use vendor\Router;
include_once '../config/app_config.php';
include_once '../vendor/helpers.php';
include_once '../config/routes.php';

\vendor\App::run();

\vendor\App::add('test', "TESTIK");

$url = trim($_SERVER["REQUEST_URI"], '/');

if (!Router::dispatch($url)) {
    echo '404';
}