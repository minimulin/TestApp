<?php

namespace TestApp\Kernel\Controller;

use TestApp\Kernel\App;
use Exception;
use TestApp\Kernel\Controller\Request as Request;

/**
* Базовый контроллер. Родитель для остальных контроллеров
*/
class BaseController
{
	protected $template;
	protected $app;
	protected $pageTitle;

	function __construct()
	{
		$this->app = App::getInstance();
	}
	
	/**
	 * Выполняет установку шаблона для вывода
	 * @param string $template Шаблон
	 * @throws \Exceprion Если шаблон не найден
	 */
	public function setTemplate($template)
	{
		$tplPath = App::getRoot() . App::getConfig('tplPath');
		$fullTemplatePath = $tplPath . '/' . $template;

		if (file_exists($fullTemplatePath)) {
			$this->template = $fullTemplatePath;
		} else {
			throw new Exception('Шаблон ' . $template . ' не найден', 1);
		}
	}

	/**
	 * Возвращает шаблон контроллера
	 * @return string Шаблон
	 */
	public function getTemplate()
	{
		return $this->template;
	}

	/**
	 * Выполняет запуск метода контроллера, ответственного за роут
	 * @param  tring $action Метод
	 */
	public function runAction($action)
	{
		if (!$action || !is_callable(array($this, $action))) {
			throw new Exception('Метод ' . get_class($this) . '@' . $action . ' не найден', 1);
        } else {
        	//Данные, возвращаемые контроллером, будут доступны внутри шаблона в переменной $data
			$data = $this->$action();
			//Инициализируем остальные переменные, которые хотим видеть в шаблоне
			$app = $this->app;
			$request = $app->getRequest();

			if (isset($this->template)) {
				//Вызов шаблона
	         	require $this->template;
			} else {
				//Если шаблон не указан, то просто выводим текст, сгенерированный контроллером
				echo $data;
			}
        }
	}

	/**
	 * Устанавливает title страницы
	 * @param string $title Title страницы
	 */
	public function setTitle($title)
	{
		$this->pageTitle = $title;
	}

	/**
	 * Возвращает указанный title страницы
	 * @return string Title страницы
	 */
	public function getTitle()
	{
		return $this->pageTitle;
	}

	/**
	 * Контроллер по умолчанию для отработки 404 ошибки
	 * @return String Ответ
	 */
	public function action404()
    {
        return 'Страница не найдена';
    }
}