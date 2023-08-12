<?php


namespace vendor;


class App
{
    private static Container $container;

    static public function run() : void
    {
        session_start();
        self::$container = Container::getInstance();
    }

    static public function add(string $name, mixed $value) : void
    {
        self::$container->add($name, $value);
    }

    static public function get(string $name) : mixed
    {
        return self::$container->get($name);
    }

}