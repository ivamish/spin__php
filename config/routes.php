<?php

use vendor\Router;

// страница с игрой
Router::add('', ['MainController' => 'index']);

// страница приветствия
Router::add('welcome', ['WelcomeController' => 'index']);

// страница авторизации
Router::add('auth', ['AuthController' => 'index']);

// страница регистрации
Router::add('register', ['RegisterController' => 'index']);

/*= POST-запросы =*/
Router::add('signin', ['AuthController' => 'signin']);
Router::add('signup', ['RegisterController' => 'signup']);
Router::add('logout', ['AuthController' => 'logout']);

/*= Ajax-запросы =*/
Router::add('spin', ['MainController' => 'spin']);

// для тестов
Router::add('test', ['TestController' => 'index']);