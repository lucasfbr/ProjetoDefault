<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'painel'], function (){

    //HomeController
    Route::get('/', 'Painel\HomeController@index');
    //PostController
    Route::get('/post', 'Painel\PostController@index');
    Route::get('/post/add', 'Painel\PostController@add');
    Route::post('/post/create', 'Painel\PostController@create');
    Route::get('/post/detail/{id}', 'Painel\PostController@detail');
    Route::get('/post/edit/{id}', 'Painel\PostController@edit');
    Route::post('/post/update/{id}', 'Painel\PostController@update');
    Route::get('/post/delete/{id}', 'Painel\PostController@delete');

    //UserController
    Route::get('/user', 'Painel\UserController@index');
    Route::get('/user/add', 'Painel\UserController@add');
    Route::post('/user/create', 'Painel\UserController@create');
    Route::get('/user/detail/{id}', 'Painel\UserController@detail');
    Route::get('/user/edit/{id}', 'Painel\UserController@edit');
    Route::post('/user/update/{id}', 'Painel\UserController@update');
    Route::get('/user/delete/{id}', 'Painel\UserController@delete');
    //RoleController
    Route::get('/role', 'Painel\RoleController@index');
    //PermissionController
    Route::get('/permission', 'Painel\PermissionController@index');

});

Auth::routes();

Route::get('/', 'Portal\HomeController@index');