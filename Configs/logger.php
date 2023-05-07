<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// Создаем экземпляр логгера
$log = new Logger('my_logger');

// Устанавливаем обработчик для записи логов в файл
$log->pushHandler(new StreamHandler('./files/log/app.log', Logger::DEBUG));

return $log;