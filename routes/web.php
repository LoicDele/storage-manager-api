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

$router->get('/', function () {
    return 'API storage-manager';
});
//Routing for products
$router->get('/products', 'ProductController@index');

$router->get('/product/{id}', 'ProductController@show');

//Routing for product's categories

//Routing for product's suppliers
