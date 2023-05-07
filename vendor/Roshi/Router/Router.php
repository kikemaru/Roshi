<?php

namespace Bot\Router;
use Bot\Start;

class Router extends Route
{
    /**
     *
     * @param Start $bot
     * @return void
     */
    public static function start(Start $bot): void
    {
        $command = explode(" ", $bot->text);
        switch ($bot->type)
        {
            case 'message':
                if (isset(self::$routes['message'][$bot->text]))
                {
                    if (isset(self::$routes['message'][$bot->text]['middleware']))
                    {
                        if (isset(self::$routes['message'][$bot->text]['params']))
                        {
                            if(!self::callMiddleware(
                                self::$routes['message'][$bot->text]['middleware'],
                                self::$routes['message'][$bot->text]['action'],
                                $bot,
                                self::$routes['message'][$bot->text]['params']
                            )){
                                self::callAction(
                                    self::$routes['message'][$bot->text]['action']['class'],
                                    self::$routes['message'][$bot->text]['action']['method'],
                                    $bot,
                                    self::$routes['message'][$bot->text]['params']
                                );
                            }
                        } else {
                            if (!self::callMiddleware(
                                self::$routes['message'][$bot->text]['middleware'],
                                self::$routes['message'][$bot->text]['action'],
                                $bot
                            )) {
                                self::callAction(
                                    self::$routes['message'][$bot->text]['action']['class'],
                                    self::$routes['message'][$bot->text]['action']['method'],
                                    $bot
                                );
                            }
                        }
                    } else {
                        if (isset(self::$routes['message'][$bot->text]['params'])) {
                            self::callAction(
                                self::$routes['message'][$bot->text]['action']['class'],
                                self::$routes['message'][$bot->text]['action']['method'],
                                $bot,
                                self::$routes['message'][$bot->text]['params']
                            );
                        } else {
                            self::callAction(
                                self::$routes['message'][$bot->text]['action']['class'],
                                self::$routes['message'][$bot->text]['action']['method'],
                                $bot
                            );
                        }
                    }
                } else {
                    /*
                     * Ошибка несуществующего сообщения
                     */
                    self::callStaticMiddleware($bot);
                } break;
            case 'callback':
                if (isset(self::$routes['callback'][$bot->text]))
                {
                    if (isset(self::$routes['callback'][$bot->text]['middleware']))
                    {
                        if (isset(self::$routes['callback'][$bot->text]['params']))
                        {
                            if(!self::callMiddleware(
                                self::$routes['callback'][$bot->text]['middleware'],
                                self::$routes['callback'][$bot->text]['action'],
                                $bot,
                                self::$routes['callback'][$bot->text]['params']
                            )){
                                self::callAction(
                                    self::$routes['callback'][$bot->text]['action']['class'],
                                    self::$routes['callback'][$bot->text]['action']['method'],
                                    $bot,
                                    self::$routes['callback'][$bot->text]['params']
                                );
                            }
                        } else {
                            if (!self::callMiddleware(
                                self::$routes['callback'][$bot->text]['middleware'],
                                self::$routes['callback'][$bot->text]['action'],
                                $bot
                            )) {
                                self::callAction(
                                    self::$routes['callback'][$bot->text]['action']['class'],
                                    self::$routes['callback'][$bot->text]['action']['method'],
                                    $bot
                                );
                            }
                        }
                    } else {
                        if (isset(self::$routes['callback'][$bot->text]['params'])) {
                            self::callAction(
                                self::$routes['callback'][$bot->text]['action']['class'],
                                self::$routes['callback'][$bot->text]['action']['method'],
                                $bot,
                                self::$routes['callback'][$bot->text]['params']
                            );
                        } else {
                            self::callAction(
                                self::$routes['callback'][$bot->text]['action']['class'],
                                self::$routes['callback'][$bot->text]['action']['method'],
                                $bot
                            );
                        }
                    }
                } else {
                    /*
                     * Ошибка несуществующего сообщения
                     */
                    self::callStaticMiddleware($bot);
                } break;
            default: echo 'ошибка запроса';
        }
    }

    private static function callMiddleware(string $name, array $route, $bot, $params = null): bool
    {
        $middlewares = require '../Configs/alias.php';
        if (isset($middlewares['middleware'][$name]))
        {
            $class = $middlewares['middleware'][$name]['class'];
            $method = $middlewares['middleware'][$name]['method'];
            if ($params == null) {
                $exemp = new $class($bot, $route);
                $exemp->$method();
            } else {
                $exemp = new $class($bot, $route, $params);
                $exemp->$method();
            }
            return true;
        }
        return false;
    }

    private static function callAction(string $class, string $method, $bot, $params = null)
    {
        if ($params == null) {
            $exemp = new $class($bot);
            $exemp->$method();
        } else {
            $exemp = new $class($bot, $params);
            $exemp->$method();
        }
    }

    private static function callStaticMiddleware($bot)
    {
        $exemp = new \App\Bot\Middleware\Middleware($bot);
        $exemp->index();
    }
}