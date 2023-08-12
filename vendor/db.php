<?php


namespace vendor;


use vendor\traits\TSingletone;

class db
{
    private static \PDO $instance;

    public static function connect() : \PDO
    {
        if(empty(self::$instance)){
            $conf = require_once CONF . '/db_config.php';
            $servername = $conf["servername"];
            $username = $conf["username"];
            $password = $conf["password"];
            $myDB = $conf["db_name"];
            try {
                self::$instance = new \PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        return self::$instance;
    }

}