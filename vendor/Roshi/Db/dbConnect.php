<?php

namespace Bot\Db;
use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\QueryException;

class dbConnect
{

    /**
     * Подключение к базе данных
     * @return void
     */
    public static function connect()
    {
        $db = new DB;
        $config = require '../Configs/database.php';

        try {
            $db->addConnection([
                'driver' => $_ENV['DB_DRIVER'],
                'host' => $_ENV['DB_HOST'],
                'database' => $_ENV['DB_database'],
                'username' => $_ENV['DB_username'],
                'password' => $_ENV['DB_password'],
                'charset' => $config['charset'],
                'collation' => $config['collation'],
            ]);
            $db->setAsGlobal();
            $db->bootEloquent();

            // Проверка подключения
            $connection = $db->getConnection();
            if ($connection->getPdo()) {
                echo "<br>Подключение к базе данных успешно установлено.<br>";
            } else {
                echo "<br>Не удалось подключиться к базе данных.<br>";
            }
        } catch (QueryException $e) {
            echo "<br>Произошла ошибка при подключении к базе данных: " . $e->getMessage() ."<br>";
        }
    }
}