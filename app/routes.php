<?php

$router = router();

$router->get('/','HomeController@index');
$router->get('/login','AuthController@index');
$router->post('/login','AuthController@login');
$router->get('/tasks','TaskController@index');
$router->post('/tasks','TaskController@store');