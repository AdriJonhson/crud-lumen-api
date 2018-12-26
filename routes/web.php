<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function() {
    return str_random(32);
});

$router->get('/categories', 'CategoryController@index');
$router->post('/categories/store', 'CategoryController@store');
$router->put('/categories/{slug}/edit', 'CategoryController@update');
$router->delete('/categories/{slug}/delete', 'CategoryController@delete');
$router->get('/categories/{slug}', 'CategoryController@show');

$router->get('/products', 'ProductController@index');
$router->get('/products/{slug}', 'ProductController@show');
$router->post('/products/store', 'ProductController@store');
$router->put('/products/{slug}/edit', 'ProductController@update');
$router->delete('/products/{slug}/delete', 'ProductController@delete');