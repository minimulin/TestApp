<?php

namespace TestApp\Model;

use TestApp\Kernel\Database\AbstractModel;

/**
 * Модель для работы с отзывами
 */
class Reply extends AbstractModel
{
    public static function getTableName()
    {
        return 'replies';
    }

}
