<?php

namespace TestApp\Kernel\Database;

/**
 * Базовый класс для моделей
 */
abstract class AbstractModel
{
	abstract public static function getTableName();

    public static function findAll()
    {
        $query = 'SELECT * FROM `' . static::getTableName() . '`';

        $statement = Connection::prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }
}
