<?php

namespace TestApp\Kernel\Controller;

use TestApp\Kernel\ConfigReader;
use TestApp\Kernel\Controller\Request;
use \Exception;

/**
 * Класс для обработки роутов
 */
class Router
{
	//Массив роутов
    protected $routeMapping;

    public function __construct()
    {
        $this->fillRouteMapping();
    }

    /**
     * Получаем массив соответствия url'а к контроллеру
     */
    protected function fillRouteMapping()
    {
        $this->routeMapping = ConfigReader::read('config/routing.php');
    }

    /**
     * Выполняем поиск подходящего контроллера по маппингу роутов
     * @todo Необходимо доработать механизм маппинга роутов и их поиска, т.к. есть вероятность на то, что напоремся на не тот роут
     * @return array Массив из имени контроллера и метода
     */
    protected function resolveController()
    {
        $url = Request::getUri();
        $routes = array_keys($this->routeMapping);
        $routeMatch = false;

        foreach ($routes as $key => $route) {
            if (preg_match($route, $url)) {
                $routeMatch = $key;
                break;
            }
        }

        $controller = $this->routeMapping[$routes[$routeMatch]];

        return split('@', $controller);
    }

    /**
     * Запуск контроллера на исполнение
     */
    public function handle()
    {
        list($controllerClass, $action) = $this->resolveController();
        $controller = new $controllerClass;
        $action = 'action' . ucfirst($action);

        $data = $controller->runAction($action);
        echo $data;
    }

}
