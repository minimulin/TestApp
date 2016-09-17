<?php

namespace TestApp\Kernel\Controller;

use TestApp\Kernel\Controller\Router;

/**
 * Класс для обработки запроса
 */
class Request
{
    protected static $uri;

    //Массив GET-параметров
    protected static $get;

    //Массив POST-параметров
    protected static $post;

    //Массив всех параметров
    protected static $params;

    //Домен, на котором всё работает
    protected static $domain;

    //Экземпляр роутера
    protected static $router;

    //Экземпляр запроса
    protected static $instance;

    protected function __clone()
    {
    }

    public function __construct()
    {
    }

    private function __wakeup()
    {
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
            //Инициализируем все необходимые переменные
            self::$uri = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
            self::$get = $_GET;
            self::$post = $_POST;
            self::$params = $_REQUEST;
            self::$domain = $_SERVER['SERVER_NAME'];
            self::$router = new Router();
        }

        return self::$instance;
    }

    /**
     * Возвращает URI
     * @return string URI
     */
    public function getUri()
    {
        return self::$uri;
    }

    /**
     * Обрабатывает запрос
     */
    public function handleRequest()
    {
        self::$router->handle();
    }

    /**
     * Возвращает домен, на котором всё работает
     * @return string Домен
     */
    public function getDomain()
    {
        return self::$domain;
    }

    /**
     * Возвращает искомый GET-параметр или полностью весь массив
     * @param  string $param Параметр
     * @return mixed GET-параметр
     */
    public function get($param = null)
    {
        if (!is_null($param)) {
            return self::$get[$param];
        }

        return self::$get;
    }

    /**
     * Аналогично методу get или post, но работа ведётся со всеми методами запроса
     * @param  string $param Параметр
     * @return mixed Параметр
     */
    public function all($param = null)
    {
        if (!is_null($param)) {
            return self::$params;[$param];
        }

        return self::$params;
    }

    /**
     * Возвращает искомый POST-параметр или полностью весь массив
     * @param  string $param Параметр
     * @return mixed POST-параметр
     */
    public function post($param)
    {
        if (!is_null($param)) {
            return self::$post[$param];
        }

        return self::$post;
    }

}
