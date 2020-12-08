<?php

$router->get('', 'PagesController@home');
$router->get('login', 'PagesController@login');
$router->get('register', 'PagesController@register');

$router->post('user/auth', 'UsersController@authenticate');
$router->get('users', 'UsersController@loadAll');
$router->post('user', 'UsersController@store');
$router->put('user/toogle-access', 'UsersController@toogleAccess');



$router->get('clients', 'ClientsController@loadAll');
$router->post('client', 'ClientsController@store');
$router->put('client', 'ClientsController@update');
$router->delete('client', 'ClientsController@delete');
$router->get('client/getInfo', 'ClientsController@getInfo');
$router->get('client/getFullInfo', 'ClientsController@getFullInfo');


$router->get('address/getInfo', 'AddressesController@getInfo'); // Carrega as informações de um determinado endereço
$router->get('addresses', 'AddressesController@loadAllById'); // Carrega todos os enderecos de um determinado usuário (se for adm, carrega todos)
$router->post('address', 'AddressesController@store');
$router->put('address', 'AddressesController@update');
$router->put('address/main-address', 'AddressesController@toogleMainAddress');
$router->delete('address', 'AddressesController@delete');
