<?php

namespace Bot\Middleware;

use Bot\Start;

class Middleware
{
    protected $class = '';
    protected $method = '';

    protected Start $bot;
    protected $params;

    public function __construct($bot, $route = null, $params = null)
    {
        $this->class = $route['class'];
        $this->method = $route['method'];
        $this->bot = $bot;
        $this->params = $params;
    }


    public function next($classController = null, $methodController = null)
    {
        if (!empty($this->class) && !empty($this->method)) {
            $class = $this->class;
            $method = $this->method;
            $exemp = new $class($this->bot);
            $exemp->$method($this->params);
        } else {
            if ($classController == null) {
                $exemp = new \App\Bot\Controller\Controller($this->bot);
                $exemp->index();
            } else {
                $exemp = new $classController($this->bot);
                $exemp->$methodController($this->params);
            }
        }
    }

    public function fail()
    {
        $exemp = new \App\Bot\Controller\Controller($this->bot);
        $exemp->fail();
    }
}