<?php

$router->get('', 'PagesController@home');
$router->get('about', 'PagesController@about');

$router->get('user', 'UsersController@listAll');
$router->post('user', 'UsersController@store');

$router->post('client', 'ClientsController@store');