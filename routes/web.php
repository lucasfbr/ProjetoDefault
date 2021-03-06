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

/*
 * Na rota painel temos dois middlewares o "auth" responsavel por verificar se o usuario esta autenticado
 * e o "tipo" que verifica qual usuario esta cadastrado no sistema, pode ser Administrador,consultor ou cliente,
 * caso seja cliente o usuario e direcionado para a rota campus
 */
Route::group(['middleware' => ['auth'], 'prefix' => 'painel'], function (){

    //HomeController
    Route::get('/', 'Painel\HomeController@index');

    //PostController
    Route::get('/post/{tipo}', 'Painel\PostController@index');
    Route::get('/post/add/{tipo}', 'Painel\PostController@add');
    Route::post('/post/create', 'Painel\PostController@create');
    Route::get('/post/detail/{id}/{tipo}', 'Painel\PostController@detail');
    Route::get('/post/edit/{id}/{tipo}', 'Painel\PostController@edit');
    Route::post('/post/update/{id}', 'Painel\PostController@update');
    Route::get('/post/delete/{id}/{tipo}', 'Painel\PostController@delete');
    Route::get('/post/restore/{id}', 'Painel\PostController@restore');

    //Categoria
    Route::get('/categoria', 'Painel\CategoriaController@index');
    Route::get('/categoria/add', 'Painel\CategoriaController@add');
    Route::post('/categoria/create', 'Painel\CategoriaController@create');
    Route::get('/categoria/edit/{id}', 'Painel\CategoriaController@edit');
    Route::post('/categoria/update/{id}', 'Painel\CategoriaController@update');
    Route::get('/categoria/delete/{id}', 'Painel\CategoriaController@delete');

    //ArtigoController
    Route::get('/artigo/', 'Painel\ArtigoController@index');
    Route::get('/artigo/lixeira', 'Painel\ArtigoController@lixeira');
    Route::get('/artigo/limparlixeira', 'Painel\ArtigoController@limparLixeira');
    Route::get('/artigo/add/', 'Painel\ArtigoController@add');
    Route::post('/artigo/create', 'Painel\ArtigoController@create');
    Route::get('/artigo/detail/{id}/', 'Painel\ArtigoController@detail');
    Route::get('/artigo/edit/{id}/', 'Painel\ArtigoController@edit');
    Route::post('/artigo/update/{id}', 'Painel\ArtigoController@update');
    Route::get('/artigo/delete/{id}/', 'Painel\ArtigoController@delete');
    Route::get('/artigo/restore/{id}', 'Painel\ArtigoController@restore');

    //UserController
    Route::get('/user', 'Painel\UserController@index');
    Route::get('/user/consultores/{service_id}', 'Painel\UserController@consultores');
    Route::get('/user/list', 'Painel\UserController@listUser');
    Route::get('/user/add', 'Painel\UserController@add');
    Route::post('/user/create', 'Painel\UserController@create');
    Route::get('/user/detail/{id}', 'Painel\UserController@detail');
    Route::get('/user/edit/{id}', 'Painel\UserController@edit');
    Route::post('/user/update/{id}', 'Painel\UserController@update');
    Route::get('/user/delete/{id}', 'Painel\UserController@delete');
    Route::get('/user/ativar/{id}', 'Painel\UserController@ativar');
    Route::get('/user/desativar/{id}', 'Painel\UserController@desativar');
    Route::get('/user/role', 'Painel\UserController@userRole');
    Route::get('/user/role/show/{id}', 'Painel\UserController@userRoleShow');
    Route::get('/user/role/add/{id}', 'Painel\UserController@roleAdd');
    Route::post('/user/role/create/{id}', 'Painel\UserController@roleCreate');
    Route::post('/user/addUserService/{id}', 'Painel\UserController@addUserService');
    Route::get('/user/role/delete/{id}/{role}', 'Painel\UserController@userRoleDelete');

    //PerfilController
    Route::get('/perfil/{id}', 'Painel\PerfilController@index');
    Route::get('/perfil/add', 'Painel\PerfilController@add');
    Route::post('/perfil/create', 'Painel\PerfilController@create');
    Route::get('/perfil/detail/{id}', 'Painel\PerfilController@detail');
    Route::get('/perfil/edit/{id}', 'Painel\PerfilController@edit');
    Route::post('/perfil/update/{id}', 'Painel\PerfilController@update');
    Route::get('/perfil/delete/{id}', 'Painel\PerfilController@delete');

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
    Route::get('/role/show/{id}', 'Painel\RoleController@show');
    Route::get('/role/add', 'Painel\RoleController@add');
    Route::get('/role/add/permission/{role_id}', 'Painel\RoleController@addPermission');
    Route::post('/role/create', 'Painel\RoleController@create');
    Route::post('/role/create/permission/{role_id}', 'Painel\RoleController@createPermission');
    Route::get('/role/edit/{id}', 'Painel\RoleController@edit');
    Route::post('/role/update/{id}', 'Painel\RoleController@update');
    Route::get('/role/delete/{id}', 'Painel\RoleController@delete');
    Route::get('/role/delete/permission/{role_id}/{permission_id}', 'Painel\RoleController@deletePermission');


    //PermissionController
    Route::get('/permission', 'Painel\PermissionController@index');
    Route::get('/permission/add', 'Painel\PermissionController@add');
    Route::post('/permission/create', 'Painel\PermissionController@create');
    Route::get('/permission/edit/{id}', 'Painel\PermissionController@edit');
    Route::post('/permission/update/{id}', 'Painel\PermissionController@update');
    Route::get('/permission/delete/{id}', 'Painel\PermissionController@delete');

    //MensagemController
    Route::get('/mensagem', 'Painel\MensagemController@index');
    Route::get('/mensagem/search', 'Painel\MensagemController@search');
    Route::get('/mensagem/read/{id}', 'Painel\MensagemController@read');
    Route::get('/mensagem/read/print/{id}', 'Painel\MensagemController@readPrint');
    Route::post('/mensagem/read/resposta/{id}', 'Painel\MensagemController@resposta');
    Route::get('/mensagem/trash', 'Painel\MensagemController@trash');
    Route::get('/mensagem/trash/search', 'Painel\MensagemController@searchTrash');
    Route::get('/mensagem/trash/destroy/{id}', 'Painel\MensagemController@destroy');
    Route::get('/mensagem/trash/restore/{id}', 'Painel\MensagemController@restore');
    Route::get('/mensagem/delete/{ids}', 'Painel\MensagemController@delete');

    Route::get('/experienciaprofissional/find/{id}', 'Painel\ExperienciasprofissionaisController@find');
    Route::post('/experienciaprofissional/add', 'Painel\ExperienciasprofissionaisController@create');
    Route::get('/experienciaprofissional/delete/{id}', 'Painel\ExperienciasprofissionaisController@delete');

});

Route::group(['middleware' => 'auth', 'prefix' => 'campus'], function (){

    //HomeController
    Route::get('/', 'Campus\HomeController@index');

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

//ArtigosController
Route::get('/artigos', 'Portal\ArtigoController@index');
Route::get('/artigos/show/{id}', 'Portal\ArtigoController@show');

//ContatoController
Route::post('/mensagens/create', 'Portal\MensagemController@create');

//envio de email
/*Route::post('/sendmail', function (\Illuminate\Http\Request $request, \Illuminate\Mail\Mailer $mailer){

    $mailer->to('lucasfbr03@gmail.com')
           ->send(new \App\Mail\ContatoMail(
            $request->input('nome'),
            $request->input('email'),
            $request->input('telefone'),
            $request->input('mensagem')
        ));

    return redirect()->back();

})->name('sendmail');*/


