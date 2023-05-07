<?php

namespace Bot\Middleware;

use Bot\Start;

class Middleware
{
    protected $class = '';
    protected $method = '';

    protected Start $bot;

    public function __construct($bot, $route = null)
    {
        $this->class = $route['class'];
        $this->method = $route['method'];
        $this->bot = $bot;
    }


    public function next($classController = null, $methodController = null)
    {
        if (!empty($this->class) && !empty($this->method)) {
            $class = $this->class;
            $method = $this->method;
            $exemp = new $class($this->bot);
            $exemp->$method();
        } else {
            if ($classController == null) {
                $exemp = new \App\Bot\Controller\Controller($this->bot);
                $exemp->index();
            } else {
                $exemp = new $classController($bot);
                $exemp->$methodController();
            }
        }
    }

    public function fail()
    {
        $exemp = new \App\Bot\Controller\Controller($this->bot);
        $exemp->fail();
    }
}