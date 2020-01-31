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
});

$router->group(['middleware'=>['auth']], function ($router) {

    $router->post('/register', 'AuthController@register');

    //Product
    $router->get('/products', 'ProductController@index');
    $router->post('/product', 'ProductController@store');
    $router->get('/product/{id}', 'ProductController@show');
    $router->put('/product/{id}', 'ProductController@update');
    $router->delete('/product/{id}', 'ProductController@delete');
    //Customer
    $router->get('/customers', 'CustomerController@index');
    $router->post('/customer', 'CustomerController@store');
    $router->get('/customer/{id}', 'CustomerController@show');
    $router->put('/customer/{id}', 'CustomerController@update');
    $router->delete('/customer/{id}', 'CustomerController@delete');
    //Supplier
    $router->get('/suppliers', 'SupplierController@index');
    $router->post('/supplier', 'SupplierController@store');
    $router->get('/supplier/{id}', 'SupplierController@show');
    $router->put('/supplier/{id}', 'SupplierController@update');
    $router->delete('/supplier/{id}', 'SupplierController@delete');
    //categories
    $router->get('/categories', 'CategoryController@index');
    $router->post('/category', 'CategoryController@store');
    $router->get('/category/{id}', 'CategoryController@show');
    $router->put('/category/{id}', 'CategoryController@update');
    $router->delete('/category/{id}', 'CategoryController@delete');
    //incoming goods
    $router->get('/incoming-goods', 'IncomingGoodsController@index');
    $router->post('/incoming-goods', 'IncomingGoodsController@store');
    $router->get('/incoming-goods/{id}', 'IncomingGoodsController@show');
    $router->delete('/incoming-goods/{id}', 'IncomingGoodsController@delete');
    $router->get('/incoming-goods/search-by-invoice/{invoice}', 'IncomingGoodsController@getByInvoice');
    $router->post('/incoming-goods/search-by-rang-dae', 'IncomingGoodsController@getByRangeDate');
    //outcoming goods
    $router->get('/outcoming-goods', 'OutcomingGoodsController@index');
    $router->post('/outcoming-goods', 'OutcomingGoodsController@store');
    $router->get('/outcoming-goods/{id}', 'OutcomingGoodsController@show');
    $router->delete('/outcoming-goods/{id}', 'OutcomingGoodsController@delete');
    $router->get('/outcoming-goods/search-by-invoice/{invoice}', 'OutcomingGoodsController@getByInvoice');
    $router->post('/outcoming-goods/search-by-rang-dae', 'OutcomingGoodsController@getByRangeDate');
    //inventori_taking
    $router->get('/inventory-taking', 'InventoryTakingController@index');
    $router->post('/inventory-taking', 'InventoryTakingController@store');
    $router->get('/inventory-taking/{id}', 'InventoryTakingController@show');
    $router->delete('/inventory-taking/{id}', 'InventoryTakingController@delete');
});
