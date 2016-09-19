<?php

namespace TestApp\Kernel\Database;

/**
 * Базовый класс для моделей
 * @todo Абстрактный класс без метода findAll не нужен. Можно заменить
 */
abstract class AbstractModel
{
	abstract public static function getTableName();
}