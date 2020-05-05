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
$router->get('/products/{id}', 'ProductController@show');
$router->post('/products', 'ProductController@create');
$router->put('/products/{id}', 'ProductController@update');
$router->delete('products/{id}', 'ProductController@delete');
//Routing for product categories
$router->get('/productCategories', 'ProductCategoryController@index');
$router->get('/productCategories/{id}', 'ProductCategoryController@show');
$router->post('/productCategories', 'ProductCategoryController@create');
$router->put('/productCategories/{id}', 'ProductCategoryController@update');
$router->delete('productCategories/{id}', 'ProductCategoryController@delete');
//Routing for product's suppliers
$router->get('/productSuppliers', 'SupplierController@index');
$router->get('/productSuppliers/{id}', 'SupplierController@show');
$router->post('/productSuppliers', 'SupplierController@create');
$router->put('/productSuppliers/{id}', 'SupplierController@update');
$router->delete('productSuppliers/{id}', 'SupplierController@delete');
//Routing for product's suppliers
$router->get('/transactions', 'TransactionController@index');
$router->get('/transactions/{id}', 'TransactionController@show');
$router->post('/transactions', 'TransactionController@create');
$router->put('/transactions/{id}', 'TransactionController@update');
$router->delete('transactions/{id}', 'TransactionController@delete');
//Routing for payment types
$router->get('/paymentTypes', 'PaymentTypeController@index');
$router->get('/paymentTypes/{id}', 'PaymentTypeController@show');
$router->post('/paymentTypes', 'PaymentTypeController@create');
$router->put('/paymentTypes/{id}', 'PaymentTypeController@update');
$router->delete('paymentTypes/{id}', 'PaymentTypeController@delete');
//Routing for Transactions
$router->get('/transactions', 'TransactionController@index');
$router->get('/transactions/{id}', 'TransactionController@show');
$router->post('/transactions', 'TransactionController@create');
$router->put('/transactions/{id}', 'TransactionController@update');
$router->delete('transactions/{id}', 'TransactionController@delete');
