<?php

namespace App\Bot\Controller;

use Bot\Telegram\keyBoard;
use Bot\Telegram\Send;

class startController extends \Bot\Controller\Controller
{
    public function index()
    {
        $text = "Привет!";
//        $this->callModel('App\Bot\Model\MainModel', 'index');

        $keyboard = keyBoard::keyboard([
            ['кнопка', 'кнопка'],
            ['кнопка', 'кнопка'],
            ['кнопка', 'кнопка']
        ]);

        $inline = keyBoard::inline([
            [
                ['callback_data' => 'callback', 'text' => 'кнопка'],
                ['callback_data' => 'callback', 'text' => 'кнопка']
            ]
        ]);
        Send::message($text);
    }



    public function command()
    {
        //реализация команды
    }
}