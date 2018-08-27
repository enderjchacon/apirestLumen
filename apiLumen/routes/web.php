<?php


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function (){
    return str_random(25);
});

$router->get('/users', ['uses'=> 'UserController@index']);