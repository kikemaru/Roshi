<?php

namespace App\Bot\Middleware;
use Illuminate\Database\Capsule\Manager as DB;

class Middleware extends \Bot\Middleware\Middleware
{
    public function index()
    {
        if (/*условие */)
            $this->next();
        else
            $this->fail();
    }
}