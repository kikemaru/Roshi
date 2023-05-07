<?php
return [
    'middleware' => [


        /* middleware name */
        'hello' => [
            /* middleware class */
            'class' => 'App\Bot\Middleware\testMiddleware',
            /* middleware method */
            'method' => 'index',
        ],


    ],


    'command' => [

        /* название команды */
        'test' => [
            /* command class */
            'class' => 'App\Bot\Controller\startController',
            /* command method */
            'method' => 'command'
        ],


    ],
];