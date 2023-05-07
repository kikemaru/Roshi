<?php
require 'Configs/logger.php';

// Функция-обработчик ошибок
function errorHandler($level, $message, $file, $line)
{
    global $log;

    $log->error("[$level] $message in $file:$line");
}

// Функция-обработчик исключений
function exceptionHandler($exception)
{
    global $log;

    $log->error("Uncaught Exception: " . $exception->getMessage());
}

// Устанавливаем обработчики ошибок и исключений
set_error_handler('errorHandler');
set_exception_handler('exceptionHandler');