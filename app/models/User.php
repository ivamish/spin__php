<?php


namespace app\models;


class User extends Model
{
    public function authUser(string $email, string $password) : bool
    {
        $stmt = $this->db->prepare("SELECT `name`, `email`, `id` FROM `users` WHERE `email` = :email AND `password` = :password");
        $stmt->execute(['email' => $email, 'password' => $password]);
        $stmt = $stmt->fetch();

        if(empty($stmt)){
           return false;
        }

        $_SESSION['user']['name'] = $stmt['name'];
        $_SESSION['user']['email'] = $stmt['email'];
        $_SESSION['user']['id'] = $stmt['id'];

        return true;
    }

    public function issetUser($email) : bool
    {
        $stmt = $this->db->prepare("SELECT `name`, `email` FROM `users` WHERE `email` = :email");
        $stmt->execute(['email' => $email]);
        $stmt = $stmt->fetch();

        return !empty($stmt);
    }

    public function registerUser($email, $name, $password) : void
    {
        $sql = 'INSERT INTO users(email, name, password) VALUES(:email, :name, :password)';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        $id = $this->db->lastInsertId();

        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['id'] = $id;
    }

    public function logout() : void
    {
        session_destroy();
    }

    public static function isAuth() : bool
    {
        return isset($_SESSION['user']);
    }

    public static function getName() : string|null
    {
        return isset($_SESSION['user']) ? $_SESSION['user']['name'] : null;
    }
}