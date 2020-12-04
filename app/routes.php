<?php

$router->get('', 'PagesController@home');
$router->get('about', 'PagesController@about');

$router->get('users', 'UsersController@loadAll');
$router->post('user', 'UsersController@store');

$router->get('clients', 'ClientsController@loadAll');

$router->post('client', 'ClientsController@store');
$router->put('client', 'ClientsController@update');
$router->delete('client', 'ClientsController@delete');