<?php

$router = router();

/**
 * Web routes
 */
$router->get('/','HomeController@index');

$router->mount('/auth', function() use ($router) {
    $router->get('/login','AuthController@index');
});

/**
 * Api routes
 */
$router->mount('/api', function() use ($router){
    $router->mount('/auth', function() use ($router) {
        $router->post('/login','AuthController@login');
        $router->post('/status','AuthController@status');
        $router->post('/logout','AuthController@logout');
    });

    $router->mount('/tasks', function() use ($router) {
        $router->get('/','TaskController@index');
        $router->post('/','TaskController@store');
        $router->post('/(\d+)','TaskController@update');
    });
});
