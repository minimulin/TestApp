<?php

namespace TestApp\Controller;

use TestApp\Kernel\Controller\BaseController;

/**
 * Контроллер для главной и вспомогательных страниц
 */
class IndexController extends BaseController
{

    public function actionIndex()
    {
        $this->setTemplate('index.tpl');
        $this->setTitle('Главная страница');

        $data = [
            'example' => 'hello',
        ];

        return $data;
    }

    public function actionAbout()
    {
        die(var_dump('About page'));
    }

}
