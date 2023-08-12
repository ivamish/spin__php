<?php


namespace app\controllers;


class WelcomeController
{
    public function index() : void
    {
        $title = "Добро пожаловать!";
        view('welcome.index', compact('title'));
    }
}