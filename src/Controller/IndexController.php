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

        return $data;
    }

    public function actionAbout()
    {
        $this->setTemplate('about.tpl');
        $this->setTitle('О проекте');
    }

    public function action404()
    {
        $this->setTemplate('404.tpl');
        $this->setTitle('Страница не найдена');
    }

}
