<?php

namespace TestApp\Kernel\Database;

/**
 * Базовый класс для моделей
 */
interface ModelInterface
{
    public static function getTableName();
}
