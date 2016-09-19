<?php

namespace TestApp\Kernel;

use Exception;
use TestApp\Kernel\App;

/**
 * Класс для извлечения данных из конфигурационных файлов
 */
class ConfigReader
{
    public function read($path)
    {
        if ($path) {
            if (file_exists(App::getRoot() . '/' . $path)) {
                return require App::getRoot() . '/' . $path;
            } else {
                throw new Exception("Конфигурационный файл " . $path . " не существует");
            }
        }
    }
}
