<?php

namespace Bot\Controller;
//use Bot\Router\Router;

class Controller
{

    protected $bot;
    protected $params;

    public function __construct($bot = null, $params = null)
    {
        $this->bot = $bot;
        $this->params = $params;
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