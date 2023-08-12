<?php

function print_arr(array $arr) : void
{
    echo "<pre>" . print_r($arr, 1) . "</pre>";
}

function view(string $view, $vars = []) : void
{
    $path = APP . '/views/' . implode('/', explode('.', $view)) . ".php";
    ob_start();
    extract($vars);
    require_once $path;
    echo ob_get_clean();
}

function get_old_value(string $name) : mixed
{
    $value = $_SESSION['old'][$name] ?? null;
    unset($_SESSION['old'][$name]);
    return $value;
}

function isset_err(string $name) : bool
{
    return isset($_SESSION['errors'][$name]);
}

function get_errors(string $name) : mixed
{
    $err = $_SESSION['errors'][$name] ?? null;
    unset($_SESSION['errors'][$name]);
    return $err;
}