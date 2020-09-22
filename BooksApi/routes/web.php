<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
use App\Http\Controllers\BooksController;

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('/books', 'BooksController@index');
$router->post('/books', 'BooksController@store');
$router->get('/books/{id}', 'BooksController@show');
$router->put('/books/{id}', 'BooksController@update');
$router->patch('/books/{id}', 'BooksController@update');
$router->delete('/books/{id}', 'BooksController@destroy');



