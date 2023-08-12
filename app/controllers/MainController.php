<?php


namespace app\controllers;


use app\models\Model;
use vendor\App;
use app\models\User;
use app\models\Prize;

class MainController
{
    private function getSections() : array
    {
        /* Получение призов */
        $prizes = (new Prize())->getAll();

        /* Разделение призов на секторы */
        $sections['jackpot'] = $prizes['jackpot'];
        $sections['diamond'] = $prizes['diamond'];
        $sections['heart1'] = $prizes['heart'];
        $sections['zip1'] = $prizes['zip'];
        $sections['dolor'] = $prizes['dolor'];
        $sections['zip2'] = $prizes['zip'];
        $sections['heart2'] = $prizes['heart'];

        $sections['heart1']['count'] = ceil($sections['heart1']['count']/2);
        $sections['heart2']['count'] = $sections['heart2']['count'] - $sections['heart1']['count'];

        $sections['zip1']['count'] = ceil($sections['zip1']['count'] / 2);
        $sections['zip2']['count'] = $sections['zip2']['count'] - $sections['zip1']['count'];

        $i = 1;
        foreach ($sections as $name => $value) {

            $sections[$name]['isActive'] = $sections[$name]['count'] > 0;

            $sections[$name]['index'] = $i;
            $i++;
        }

        return $sections;
    }

    public function index()
    {
        if(!User::isAuth()) {
            header("Location: /welcome");
            die();
        }

        $sections = $this->getSections();

        App::add('sections', $sections);

        /* Подключение вида */

        view('index', ['sections' => $sections]);
    }

    public function spin()
    {

        /* Получаем призы и распределяем их по секциям на колесе */
        $prizes = new Prize();
        $sections = $this->getSections();

        /* Выбираем секции, на которой не кончились призы */
        $sections = array_filter($sections, function($section) { return $section['count'] > 0; });

        /* Получаем индексы секций, на которых не закончились призы */
        $indexes = [];
        foreach ($sections as $section) {
            $indexes[] = $section['index'];
        }

        if(empty($indexes)) {
            echo json_encode(false);
            return false;
        }

        /* Получаем случайную секцию */
        $item = $indexes[rand(0, count($indexes) - 1)];

        $section = array_filter($sections, function ($section) use ($item) {return $section['index'] === $item;});
        $section = array_pop($section);
        $prizes->subtract($section['id']);

        $count = $prizes->addPrizeInToUser($_SESSION['user']['id'], $section['id']);

        $response = [
            'item' => $item,
            'image' => $section['image'],
            'description' => $section['description'],
            'count' => $count
        ];
        echo json_encode($response);
    }
}