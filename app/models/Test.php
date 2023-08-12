<?php


namespace app\models;


class Test extends Model
{
    public function get_users() : array
    {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }
}