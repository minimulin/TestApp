<?php
require_once __DIR__ . '/../vendor/autoload.php';

try {
    echo TestApp\Kernel\App::getInstance()->run();
} catch (Exception $e) {
    echo 'Возникла ошибка: ' . $e->getMessage();
}
