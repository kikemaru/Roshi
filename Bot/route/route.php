<?php
use Bot\Router\Route;
global $command;

Route::command('start')
    ->action('App\Bot\Controller\startController', 'index')
    ->middleware('hello')
    ->name('name_route5');

Route::message('hello')
    ->action('startController', 'responseHello')
    ->middleware('name_middleware1')
    ->name('name_route1');

Route::callback('first')
    ->action('callbackController', 'index')
    ->middleware('name_middleware3')
    ->name('name_route3');