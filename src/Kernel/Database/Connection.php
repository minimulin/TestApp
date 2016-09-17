<?php

namespace TestApp\Kernel\Database;

use TestApp\Kernel\App;
use \PDO;

/**
 * Класс для работы с БД через PDO
 */
class Connection
{
    protected static $pdoConnection;
    protected static $databaseConfig;

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

            self::$pdoConnection = self::getConnection();
        }

        return self::$instance;
    }

    protected static function buildDsn()
    {
        self::$databaseConfig = App::getConfig('database');
        return 'mysql:dbname=' . self::$databaseConfig['database'] . ';host=' . self::$databaseConfig['host'];
    }

    protected static function getConnection()
    {
        $dsn = self::buildDsn();
        $user = self::$databaseConfig['user'];
        $password = self::$databaseConfig['pass'];

        $connection = new PDO($dsn, $user, $password);

        return $connection;
    }

    public function prepare($query)
    {
    	return self::$pdoConnection->prepare($query);
    }

}
