<?php
$router->post('/getToken', ['uses'=> 'UserController@getToken']);

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function (){
    return str_random(25);
});

$router->group(['middleware'=>'auth'],function() use($router){

    $router->get('/users', ['uses'=> 'UserController@index']);
    $router->post('/users', ['uses'=> 'UserController@createUser']);

});
