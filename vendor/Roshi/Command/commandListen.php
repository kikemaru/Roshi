<?php

namespace Bot\Command;

class commandListen
{
    public static function listen(string $name)
    {
        $commands = require '../Configs/alias.php';
        if (isset($commands['command'][$name]))
        {
            $class = $commands['command'][$name]['class'];
            $method = $commands['command'][$name]['method'];
            $exemp = new $class('command');
            $exemp->$method();
        }
        else {
            echo 'Попытка запустить несуществующую команду!';
        }
    }
}