<?php


namespace app\models;


use vendor\db;

abstract class Model
{
    protected \PDO $db;

    public function __construct()
    {
        $this->db = db::connect();
    }
}