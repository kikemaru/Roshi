<?php

namespace App\Bot\Middleware;

class testMiddleware extends \Bot\Middleware\Middleware
{
    public function index()
    {
        $this->next();
    }
}