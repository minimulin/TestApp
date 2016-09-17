<?php

/**
 * Пример роута:
 * '!^.*$!' => '\\TestApp\\Kernel\\Controller\\BaseController@404'
 * Где ключём массива выступает регулярное выражение для сравнения с URL,
 * а значением является имя класса и метода, который следует вызвать
 */
return [
	//Главная страница
	'!^\/$!' => '\\TestApp\\Controller\\IndexController@index',
	//О проекте
	'!^\/about!' => '\\TestApp\\Controller\\IndexController@about',
	//Отзывы
	'!^\/replies!' => '\\TestApp\\Controller\\ReplyController@index',
	//404
	'!^.*$!' => '\\TestApp\\Controller\\IndexController@404',
];