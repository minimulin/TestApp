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

    //Авторизация
    '!^\/login!' => '\\TestApp\\Controller\\IndexController@login',

    //Отзывы
    '!^\/replies/getData!' => '\\TestApp\\Controller\\ReplyController@getData',
    '!^\/replies/sort!' => '\\TestApp\\Controller\\ReplyController@changeSort',
    '!^\/replies/changeStatus!' => '\\TestApp\\Controller\\ReplyController@changeStatus',
    '!^\/replies/update!' => '\\TestApp\\Controller\\ReplyController@update',
    '!^\/replies/preview!' => '\\TestApp\\Controller\\ReplyController@preview',
    '!^\/replies/add!' => '\\TestApp\\Controller\\ReplyController@replyAdd',
    '!^\/replies!' => '\\TestApp\\Controller\\ReplyController@index',

    //404
    '!^.*$!' => '\\TestApp\\Controller\\IndexController@404',
];
