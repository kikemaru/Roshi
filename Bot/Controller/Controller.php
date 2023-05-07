<?php

namespace App\Bot\Controller;
use Bot\Telegram\Send;

class Controller extends \Bot\Controller\Controller
{
    public function index()
    {
        Send::message("Я передал твое сообщение администратору!");
    }

    public function fail()
    {
        Send::message("Я не знаю что ответить на это!");
    }
}