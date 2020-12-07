<?php

$router->get('', 'PagesController@home');
$router->get('login', 'PagesController@login');
$router->get('register', 'PagesController@register');
$router->get('addresses', 'AddressesController@loadAllById');

$router->get('users', 'UsersController@loadAll');
$router->post('user', 'UsersController@store');
$router->put('user/toogle-access', 'UsersController@toogleAccess');

$router->post('user/auth', 'UsersController@authenticate');

$router->get('clients', 'ClientsController@loadAll');

$router->post('client', 'ClientsController@store');
$router->put('client', 'ClientsController@update');
$router->delete('client', 'ClientsController@delete');
$router->get('client/getInfo', 'ClientsController@getInfo');


$router->put('address', 'AddressesController@store');