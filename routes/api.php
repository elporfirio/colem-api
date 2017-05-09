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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['prefix' => 'api/v1'], function() use($app){
    $app->get('/', function(){
        return "Hola API";
    });

    /** Usuarios */
    $app->get('users[/{id:\d+}]', 'UserController@show');
    $app->post('users', 'UserController@create');
    $app->put('users/{id:\d+}', 'UserController@update');
    $app->delete('users/{id:\d+}', 'UserController@delete');

    /** Series */
    $app->post('series', 'SerieController@create');
    $app->get('series[/{id:\d+}]', 'SerieController@show');
    $app->put('series/{id:\d+}', 'SerieController@update');
    $app->delete('series/{id:\d+}', 'SerieController@delete');

    /** Catalogo Mangas */
    $app->get('mangas', 'UserController@testManga');
});