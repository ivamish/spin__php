<?php


namespace app\controllers;


use app\models\Model;
use app\models\User;

class RegisterController
{
    public function index()
    {
        if(User::isAuth()) header("Location: /");
        $title = "Регистрация";
        view('welcome.register', compact('title'));
    }

    public function signup()
    {
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            header("Location: /");
            die();
        }

        $user = new User();
        $email = trim($_POST['email']);
        $name = trim($_POST['name']);
        $password = trim($_POST['password']);

        if($name == '' || $email == '' || $password) {
            $_SESSION['errors']['register'] = "Вы заполнили не все поля";
            $_SESSION['old']['email'] = $email;
            $_SESSION['old']['name'] = $name;
            $_SESSION['old']['password'] = $password;
            header("Location: /register");
            die();
        }

        if($user->issetUser($email)) {
            $_SESSION['errors']['register'] = "Пользователь с такой почтой уже существует";
            $_SESSION['old']['email'] = $email;
            $_SESSION['old']['name'] = $name;
            $_SESSION['old']['password'] = $password;
            header("Location: /register");
            die();
        }

        $user->registerUser($email, $name, $password);
        header("Location: /");
    }
}