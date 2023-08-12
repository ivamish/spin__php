<?php


namespace app\controllers;


use app\models\Model;
use app\models\User;

class AuthController
{
    public function index() : void
    {
        if(User::isAuth()) header("Location: /");
        $title = "Авторизация";
        view('welcome.auth', compact('title'));
    }

    public function signin()
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            header("Location: /");
            die();
        }

        $user = new User();
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!$user->authUser($email, $password)) {
            $_SESSION['errors']['register'] = "Неправильный логин или пароль";
            $_SESSION['old']['email'] = $email;
            $_SESSION['old']['password'] = $password;
            header("Location: /auth");
            die();
        }

        $user->authUser($email, $password);
        header("Location: /");
    }

    public function logout() : void
    {
        (new User())->logout();
        header("Location: /");
    }
}