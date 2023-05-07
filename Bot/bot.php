<?php

require __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();


if (isset($_ENV['DB_DRIVER']) && !empty($_ENV['DB_DRIVER']))
    \Bot\Db\dbConnect::connect();

if (isset($_GET['command']) && !empty($_GET['command']))
    \Bot\Command\commandListen::listen($_GET['command']);


$bot = new \Bot\Start(file_get_contents('php://input'));

/** @var array $command */
$command = explode(" ", $bot->text);


use Bot\Router\Router;
use Longman\TelegramBot\Telegram;

include './route/route.php';



if(!\Bot\WebHook::setWebHook())
    echo "<br>Ошибка подключения вебхуков!<br>";
else
    echo "<br>Вебхуки успешно настроены!<br>";

$telegram = new Telegram($_ENV['BOT_TOKEN']);

\Bot\Telegram\Send::setBot($bot);
Router::start($bot);