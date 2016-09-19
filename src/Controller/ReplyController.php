<?php

namespace TestApp\Controller;

use TestApp\Kernel\App;
use TestApp\Kernel\Controller\BaseController;
use TestApp\Kernel\Controller\Request;
use TestApp\Misc\ImageResizer;
use TestApp\Model\Reply;

/**
 * Контроллер для главной и вспомогательных страниц
 */
class ReplyController extends BaseController
{

    /**
     * Список отзывов
     */
    public function actionIndex()
    {
        if (App::isAdmin()) {
            $this->setTemplate('reply_admin.tpl');
            $onlyActive = false;
        } else {
            $this->setTemplate('reply.tpl');
            $onlyActive = true;
        }

        $this->setTitle('Обратная связь');

        $sort = App::getSession('repliesSort');
        if (!$sort) {
            $orderBy = 'created_at';
        } else {
            $orderBy = $sort;
        }
        if ($orderBy == 'created_at') {
            $asc = false;
        } else {
            $asc = true;
        }

        $replies = Reply::findAll($orderBy, $asc, $onlyActive);

        return $replies;
    }

    /**
     * Добавление отзыва
     */
    public function actionReplyAdd()
    {
        $response = [
            'result' => 'success',
        ];

        if (Request::isAjax() && Request::isPost()) {
            $fileName = $this->handleFileUpload();

            $replyData = App::getRequest()->all();
            $replyData['image'] = $fileName;

            $validationResult = Reply::validate();
            if (is_array($validationResult)) {
                $response = [
                    'result' => 'error',
                    'errors' => $validationResult,
                ];
            } else {
                if (!Reply::create($replyData)) {
                    $response = [
                        'result' => 'error',
                        'message' => 'Возникла ошибка в процессе сохранения отзыва',
                    ];
                }
            }

            return json_encode($response);
        }

        $this->redirect404();
    }

    /**
     * Обработчик загрузки изображения
     * @param  boolean $output Вернуть содержимое файла вместо физического сохранения
     */
    public function handleFileUpload($output = false)
    {
        $uploadPath = App::getRoot() . '/' . App::getConfig('uploadPath');
        $file = App::getRequest()->getFile('image');
        if ($file['error'] == UPLOAD_ERR_OK) {
            $extension = pathinfo($file["name"], PATHINFO_EXTENSION);
            $newFileName = md5(time() . $file["name"]) . '.' . $extension;
            $fullNewPath = $uploadPath . '/' . $newFileName;

            $image = new ImageResizer();
            $image->load($file["tmp_name"]);
            $image->resizeWithRatio(320, 240);

            //Для того, чтобы не сохранять лишний раз изображение, просто выводим его как base64 в src
            if ($output) {
                ob_start();
                $image->output();
                $src = ob_get_contents();
                ob_end_clean();
                return 'data:image/png;base64,' . base64_encode($src);
            } else {
                $image->save($fullNewPath);
            }

            $fileName = str_replace('public', '', App::getConfig('uploadPath')) . '/' . $newFileName;

            return $fileName;
        }
    }

    /**
     * Редирект на 404
     */
    public function redirect404()
    {
        $this->setTemplate('404.tpl');
        $this->setTitle('Страница не найдена');
        Request::setHttpCode(404);
    }

    /**
     * Смена сортировки списка отзывов
     */
    public function actionChangeSort()
    {
        $response = [
            'result' => 'success',
        ];

        if (Request::isAjax() && Request::isPost()) {
            switch (App::getRequest()->post('sort')) {
                case 'name':
                    App::setSession('repliesSort', 'name');
                    break;
                case 'email':
                    App::setSession('repliesSort', 'email');
                    break;
                case 'created_at':
                default:
                    App::setSession('repliesSort', 'created_at');
                    break;
            }
            return json_encode($response);
        }

        $this->redirect404();
    }

    /**
     * Получение предпросмотра отзыва
     */
    public function actionPreview()
    {
        $response = [
            'result' => 'success',
        ];

        if (Request::isAjax() && Request::isPost()) {
            $fileName = $this->handleFileUpload(true);

            $replyData = App::getRequest()->all();
            $replyData['image'] = $fileName;

            $validationResult = Reply::validate($replyData);
            if (is_array($validationResult)) {
                $response = [
                    'result' => 'error',
                    'errors' => $validationResult,
                ];
            } else {
                $data['reply'] = $replyData;
                $response['preview'] = $this->getView('replyElement.tpl', $data);
            }

            return json_encode($response);
        }

        $this->redirect404();
    }

    /**
     * Получение формы редактирования отзыва
     */
    public function actionGetData()
    {
        $response = [
            'result' => 'success',
        ];

        if (Request::isAjax() && Request::isPost() && App::isAdmin()) {
            $id = App::getRequest()->post('id');

            $reply = Reply::findById($id);

            if (is_array($reply) && count($reply) > 0) {
                $data['reply'] = $reply;
                $response['form'] = $this->getView('replyElementEdit.tpl', $data);
            } else {
                $response = [
                    'result' => 'error',
                    'message' => 'Отзыв не найден',
                ];
            }

            return json_encode($response);
        }

        $this->redirect404();
    }

    /**
     * Обработчик формы редактирования отзыва
     */
    public function actionUpdate()
    {
        $response = [
            'result' => 'success',
        ];

        if (Request::isAjax() && Request::isPost() && App::isAdmin()) {
            $replyData = App::getRequest()->all();

            $validationResult = Reply::validate($replyData);
            if (is_array($validationResult)) {
                $response = [
                    'result' => 'error',
                    'errors' => $validationResult,
                ];
            } else {
                if (!Reply::update($replyData)) {
                    $response = [
                        'result' => 'error',
                        'message' => 'Возникла ошибка в процессе сохранения отзыва',
                    ];
                }
            }

            return json_encode($response);
        }

        $this->redirect404();
    }

    /**
     * Обработчик смены статуса отзыва
     */
    public function actionChangeStatus()
    {
        $response = [
            'result' => 'success',
        ];

        if (Request::isAjax() && Request::isPost() && App::isAdmin()) {
            $replyId = App::getRequest()->all('id');
            $replyStatus = App::getRequest()->all('status');
            if ($replyStatus == 'apply') {
                $statusChangeResult = Reply::apply($replyId);
            } else {
                $statusChangeResult = Reply::reject($replyId);
            }

            if (!$statusChangeResult) {
                $response = [
                    'result' => 'error',
                    'message' => 'Возникла ошибка в процессе сохранения отзыва',
                ];
            }

            return json_encode($response);
        }

        $this->redirect404();
    }

}
