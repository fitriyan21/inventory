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
$router->group(['prefix'=>'auth'], function () use ($router) {
    $router->post('/login', 'AuthController@login');
    $router->post('/register', 'AuthController@register');
});

$router->group(['middleware'=>['auth']], function ($router) {
    $router->get('/products', 'ProductController@index');
    $router->post('/product', 'ProductController@store');
    $router->get('/product/{id}', 'ProductController@show');
    $router->put('/product/{id}', 'ProductController@update');
    $router->delete('/product/{id}', 'ProductController@delete');

    $router->get('/customers', 'CustomerController@index');
    $router->post('/customer', 'CustomerController@store');
    $router->get('/customer/{id}', 'CustomerController@show');
    $router->put('/customer/{id}', 'CustomerController@update');
    $router->delete('/customer/{id}', 'CustomerController@delete');

    $router->get('/suppliers', 'SupplierController@index');
    $router->post('/supplier', 'SupplierController@store');
    $router->get('/supplier/{id}', 'SupplierController@show');
    $router->put('/supplier/{id}', 'SupplierController@update');
    $router->delete('/supplier/{id}', 'SupplierController@delete');

    $router->get('/categories', 'CategoryController@index');
    $router->post('/category', 'CategoryController@store');
    $router->get('/category/{id}', 'CategoryController@show');
    $router->put('/category/{id}', 'CategoryController@update');
    $router->delete('/category/{id}', 'CategoryController@delete');

    $router->get('/incoming-goods', 'IncomingGoodsController@index');
    $router->post('/incoming-goods', 'IncomingGoodsController@store');
    $router->get('/incoming-goods/{id}', 'IncomingGoodsController@show');
    $router->delete('/incoming-goods/{id}', 'IncomingGoodsController@delete');

    $router->get('/outcoming-goods', 'OutcomingGoodsController@index');
    $router->post('/outcoming-goods', 'OutcomingGoodsController@store');
    $router->get('/outcoming-goods/{id}', 'OutcomingGoodsController@show');
    $router->delete('/outcoming-goods/{id}', 'OutcomingGoodsController@delete');
});