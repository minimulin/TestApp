<?php

namespace TestApp\Controller;

use TestApp\Kernel\App;
use TestApp\Kernel\Controller\BaseController;
use TestApp\Kernel\Controller\Request;

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
        Request::setHttpCode(404);
    }

    /**
     * Авторизация
     */
    public function actionLogin()
    {
        $this->setTemplate('login.tpl');
        $this->setTitle('Авторизация');

        $action = Request::all('action');
        if ($action == 'logout') {
            App::clearSession();
            Request::redirect('/');
        }

        if (Request::isPost()) {
            $login = Request::post('login');
            $password = Request::post('password');

            //Не стал возиться и мудрить
            if ($login == 'admin' && $password = '123') {
                App::setSession('isAdmin', true);
                Request::redirect('/');
            }
        }
    }

}
