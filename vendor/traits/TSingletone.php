<?php


namespace vendor\traits;


trait TSingletone
{
    private static ?self $instance = null;

    private function __clone()
    {
        // close
    }

    private function __construct()
    {
        //close
    }

    public static function getInstance () : self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}