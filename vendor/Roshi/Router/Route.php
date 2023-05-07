<?php

namespace Bot\Router;

class Route
{
    /**
     * @var array
     * Все маршруты, которые зарегистрированы приложением
     */
    protected static $routes = [];

    /**
     * @var string
     */
    private static $currentRouteType = '';
    /**
     * @var string
     */
    private static $currentRouteName = '';


    /**
     * Метод для регистрации сообщений
     * @param $message
     * @return Route
     */
    public static function message($message) {
        self::$currentRouteType = 'message';
        self::$currentRouteName = $message;
        self::$routes[self::$currentRouteType][self::$currentRouteName] = [];
        return new self;
    }

    /**
     * Метод для регистрации callback
     * @param $callback
     * @return Route
     */
    public static function callback($callback) {
        self::$currentRouteType = 'callback';
        self::$currentRouteName = $callback;
        self::$routes[self::$currentRouteType][self::$currentRouteName] = [];
        return new self;
    }

    /**
     * метод для регистрации команд
     * @param $command
     * @return Route
     */
    public static function command($command) {
        self::$currentRouteType = 'message';
        self::$currentRouteName = '/'.$command;
        self::$routes[self::$currentRouteType][self::$currentRouteName] = [];
        return new self;
    }

    /**
     * Метод для подключения контроллера
     * @param $class
     * @param $method
     * @return $this
     */
    public function action($class, $method) {
        self::$routes[self::$currentRouteType][self::$currentRouteName]['action'] = [
            'class' => $class,
            'method' => $method
        ];
        return $this;
    }

    /**
     * Метод для подключения middleware
     * @param $name
     * @return $this
     */
    public function middleware($name) {
        self::$routes[self::$currentRouteType][self::$currentRouteName]['middleware'] = $name;
        return $this;
    }

    /**
     * Метод для добавления имени маршруту
     * @param $name
     * @return $this
     */
    public function name($name) {
        self::$routes[self::$currentRouteType][self::$currentRouteName]['name'] = $name;
        return $this;
    }

    public function params($params) {
        self::$routes[self::$currentRouteType][self::$currentRouteName]['params'] = $params;
        return $this;
    }
}