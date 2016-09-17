<?php

namespace TestApp\Controller;

use TestApp\Kernel\Controller\BaseController;
use TestApp\Model\Reply;

/**
 * Контроллер для главной и вспомогательных страниц
 */
class ReplyController extends BaseController
{

    public function actionIndex()
    {
        $this->setTemplate('reply.tpl');
        $this->setTitle('Обратная связь');

        $replies = Reply::findAll();

        return $replies;
    }
}
