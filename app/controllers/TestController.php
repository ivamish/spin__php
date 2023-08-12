<?php


namespace app\controllers;


use app\models\Model;
use app\models\Prize;
use app\models\Test;
use app\models\User;

class TestController
{
    public function index() : void
    {
        $id = $_SESSION['user']['id'];
        $prize_id = random_int(1, 7);

        (new Prize())->addPrizeInToUser($id, $prize_id);
    }
}