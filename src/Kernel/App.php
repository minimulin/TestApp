<?php

namespace TestApp\Kernel;

use TestApp\Kernel\Controller\Request;
use TestApp\Kernel\Database\Connection;

/**
 * Основной класс приложения
 */
class App
{
    //У нас синглтон
    protected static $instance;

    //Экземпляр запроса
    protected static $request;

    //Конфигурационный массив
    protected static $config;

    protected static $database;

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
            session_start();
        }

        return self::$instance;
    }

    /**
     * Здесь приложение начинает жить
     */
    public function run()
    {
        self::$config = ConfigReader::read('config/app.php');

        self::$database = Connection::getInstance();

        //Всё работает через класс запроса
        self::$request = Request::getInstance();
        self::$request->handleRequest();
    }

    /**
     * Возвращает конфигурационные данные
     * @param   string $key Искомый ключ
     * @return mixed        Конфигурационное значение
     */
    public static function getConfig($key = null)
    {
        if ($key) {
            return self::$config[$key];
        }

        return self::$config;
    }

    /**
     * Возвращает сессионные данные
     * @param   string $key Искомый ключ
     * @return mixed        Значение
     */
    public static function getSession($key = null)
    {
        if ($key) {
            return $_SESSION[$key];
        }

        return self::$config;
    }

    /**
     * Сохраняет сессионные данные
     * @param   string $key Ключ
     * @param   mixed $data Данные
     */
    public static function setSession($key, $data)
    {
        $_SESSION[$key] = $data;
    }

    /**
     * Очищает сессионные данные
     * @param  string $key Искомый ключ
     * @return mixed        Значение
     */
    public static function clearSession()
    {
        $_SESSION = [];
    }

    /**
     * Возвращает путь до корня приложения
     * @return string Путь до корня
     */
    public static function getRoot()
    {
        return realpath($_SERVER['DOCUMENT_ROOT'] . '/../');
    }

    /**
     * Возвращает экземпляр запроса
     * @return TestApp\Kernel\Controller\Request Запрос
     */
    public static function getRequest()
    {
        return self::$request;
    }

    public static function isAdmin()
    {
        return (bool) self::getSession('isAdmin');
    }
}
