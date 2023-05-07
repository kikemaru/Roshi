<?php

namespace Bot\Controller;
use Bot\Router\Router;

class Controller
{

    protected $bot;

    public function __construct($bot = null)
    {
        $this->bot = $bot;
    }

    /**
     * Вызов модели
     * @param $class
     * @param $method
     * @param $arg
     * @return void
     */
    protected function callModel($class, $method, $arg = [])
    {
        $exemp = new $class($this->bot);
        $exemp->$method(isset($arg) ? $arg : null);
    }

    protected function goRoute(string $name)
    {
//        Router::goRoute($name);
    }
}