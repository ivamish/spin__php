<?php

namespace vendor;

class Router {

    private static array $routes = [];
    private static string $route = '';

    public static function add(string $routeName, array $controller) : void
    {
        self::$routes[$routeName] = $controller;
    }

    public static function getRoutes() : array
    {
        return self::$routes;
    }

    public static function getRoute(string $RouteName)
    {
        return self::$routes[$RouteName] ?? false;
    }

    public static function dispatch(string $url) : bool
    {
        foreach (self::$routes as $name => $route) {
            if (preg_match("#^$name$#", $url, $matches)) {
                array_shift($matches);
                $controller = array_key_first($route);
                $action = $route[$controller];
                $controllerClass = "app\\controllers\\$controller";
                $slug = $matches[0] ?? false;

                /**
                 * Проверка наличия контроллера
                 */
                if(!class_exists($controllerClass)) {
                    throw new \Error("Контроллер $controller не найден");
//                    return false;
                }

                /**
                 * Проверка наличия метода у котроллера
                 */
                if(!method_exists($controllerClass, $action))
                {
                    throw new \Error("Метод $action у контроллера $controller не найден");
//                    return false;
                }


                /**
                 * Создание экземпляра контролера и вызов метода, в первом случае без слага, во втором - со слагом
                 */
                if(!$slug) {
                    (new $controllerClass)->$action();
                } else {
                    (new $controllerClass)->$action($slug);
                }

                return true;
            }
        }
        return false;
    }
}