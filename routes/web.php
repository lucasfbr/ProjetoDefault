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

Route::group(['middleware' => 'auth' , 'prefix' => 'painel'], function (){

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

    //ArtigoController
    Route::get('/artigo', 'Painel\ArtigoController@index');
    Route::get('/artigot/add', 'Painel\ArtigoController@add');
    Route::post('/artigo/create', 'Painel\ArtigoController@create');
    Route::get('/artigo/detail/{id}', 'Painel\ArtigoController@detail');
    Route::get('/artigo/edit/{id}', 'Painel\ArtigoController@edit');
    Route::post('/artigo/update/{id}', 'Painel\ArtigoController@update');
    Route::get('/artigo/delete/{id}', 'Painel\ArtigoController@delete');

    //UserController
    Route::get('/user', 'Painel\UserController@index');
    Route::get('/user/list', 'Painel\UserController@listUser');
    Route::get('/user/add', 'Painel\UserController@add');
    Route::post('/user/create', 'Painel\UserController@create');
    Route::get('/user/detail/{id}', 'Painel\UserController@detail');
    Route::get('/user/edit/{id}', 'Painel\UserController@edit');
    Route::post('/user/update/{id}', 'Painel\UserController@update');
    Route::get('/user/delete/{id}', 'Painel\UserController@delete');
    Route::get('/user/ativar/{id}', 'Painel\UserController@ativar');
    Route::get('/user/desativar/{id}', 'Painel\UserController@desativar');

    //ServiceController
    Route::get('/service', 'Painel\ServiceController@index');
    Route::get('/service/add', 'Painel\ServiceController@add');
    Route::post('/service/create', 'Painel\ServiceController@create');
    Route::get('/service/edit/{id}', 'Painel\ServiceController@edit');
    Route::post('/service/update/{id}', 'Painel\ServiceController@update');
    Route::get('/service/detail/{id}', 'Painel\ServiceController@detail');
    Route::get('/service/delete/{id}', 'Painel\ServiceController@delete');

    //PortifolioController
    Route::get('/portifolio', 'Painel\PortifolioController@index');
    Route::get('/portifolio/add', 'Painel\PortifolioController@add');
    Route::post('/portifolio/create', 'Painel\PortifolioController@create');
    Route::get('/portifolio/edit/{id}', 'Painel\PortifolioController@edit');
    Route::post('/portifolio/update/{id}', 'Painel\PortifolioController@update');
    Route::get('/portifolio/detail/{id}', 'Painel\PortifolioController@detail');
    Route::get('/portifolio/delete/{id}', 'Painel\PortifolioController@delete');

    //QuemSomosController
    Route::get('/quemsomos', 'Painel\QuemsomosController@index');
    Route::get('/quemsomos/add', 'Painel\QuemsomosController@add');
    Route::post('/quemsomos/create', 'Painel\QuemsomosController@create');
    Route::get('/quemsomos/edit/{id}', 'Painel\QuemsomosController@edit');
    Route::post('/quemsomos/update/{id}', 'Painel\QuemsomosController@update');
    Route::get('/quemsomos/detail/{id}', 'Painel\QuemsomosController@detail');
    Route::get('/quemsomos/delete/{id}', 'Painel\QuemsomosController@delete');

    //ConfiguracoesController
    Route::get('/configuracoes', 'Painel\ConfiguracoesController@index');
    Route::get('/configuracoes/add', 'Painel\ConfiguracoesController@add');
    Route::post('/configuracoes/create', 'Painel\ConfiguracoesController@create');
    Route::get('/configuracoes/edit/{id}', 'Painel\ConfiguracoesController@edit');
    Route::post('/configuracoes/update/{id}/{tipo}', 'Painel\ConfiguracoesController@update');
    Route::get('/configuracoes/delete/{id}', 'Painel\ConfiguracoesController@delete');

    //BannersController
    Route::post('/banner/create', 'Painel\BannerController@create');
    Route::post('/banner/update/{id}', 'Painel\BannerController@update');
    Route::get('/banner/delete/{id}', 'Painel\BannerController@delete');

    //FormacaoController
    Route::get('/formacao/{id}', 'Painel\FormacaoController@index');
    Route::get('/formacao/add/{id}', 'Painel\FormacaoController@add');
    Route::post('/formacao/create', 'Painel\FormacaoController@create');
    Route::get('/formacao/edit/{id}', 'Painel\FormacaoController@edit');
    Route::post('/formacao/update/{id}', 'Painel\FormacaoController@update');
    Route::get('/formacao/detail/{id}', 'Painel\FormacaoController@detail');
    Route::get('/formacao/delete/{id}', 'Painel\FormacaoController@delete');


    //RoleController
    Route::get('/role', 'Painel\RoleController@index');
    //PermissionController
    Route::get('/permission', 'Painel\PermissionController@index');

});

Auth::routes();

Route::get('/', 'Portal\HomeController@index');

//ServicoController
Route::get('/servicos', 'Portal\ServicosController@index');

//PortifolioController
Route::get('/portifolio', 'Portal\PortifolioController@index');

//QuemSomosController
Route::get('/quemsomos', 'Portal\QuemsomosController@index');

//NossaEquipeController
Route::get('/nossaequipe', 'Portal\NossaequipeController@index');


