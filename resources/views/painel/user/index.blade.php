@extends('painel.templates.template')

@section('content')


    <section class="content-header">
        <h1>
            Usuários
            <small>cadastrar, editar e excluir posts</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Usuários</li>
        </ol>
    </section>

    <section class="content">

        <section class="col-md-10">

            <!-- Default box -->
            <div class="box">

                <div class="box-body">

                    @if (session('sucesso'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            {{ session('sucesso') }}
                        </div>
                        <br/>
                    @elseif(session('erro'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            {{ session('erro') }}
                        </div>
                        <br/>
                    @endif


                    <a href="/painel/user/add" class="btn btn-success">Novo Usuário</a>

                    <br><br>

                    <table class="table table-bordered table-striped table-hover table-condensed">
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Estado</th>
                            <th>Cidade</th>
                            <th>Tipo</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>

                            <tr v-for="u in user | filterBy search">
                                <td width="150px">@{{u.name}}</td>
                                <td>@{{u.email}}</td>
                                <td>@{{u.estado}}</td>
                                <td>@{{u.cidade}}</td>
                                <td>@{{u.tipo}}</td>
                                <td>@{{u.status}}</td>
                                <td width="190px">
                                    <a href="/painel/user/detail/@{{u.id}}" class="btn btn-info"
                                       alt="Exibir o usuário" title="Exibir o usuário"><span
                                                class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                    <a href="/painel/user/edit/@{{u.id}}" class="btn btn-warning"
                                       alt="Editar o usuário" title="Editar o usuário"><span
                                                class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                    <a href="/painel/user/delete/@{{u.id}}"
                                       onclick="return confirm('Realmente deseja excluir este usuário?')"
                                       class="btn btn-danger" alt="Excluir o usuário"
                                       title="Excluir o usuário"><span class="glyphicon glyphicon-remove"
                                                                       aria-hidden="true"></span></a>

                                    <!--@if(( '' == 'Consultor') || ('' == 'Administrador'))
                                        @if('' == 'Ativo')
                                            <a href="/painel/user/desativar/@{{u.id}}"
                                               onclick="return confirm('Realmente deseja desativar este usuário?')"
                                               class="btn btn-success" alt="Desativar usuário"
                                               title="Desativar usuário"><span
                                                        class="glyphicon glyphicon-thumbs-down"
                                                        aria-hidden="true"></span></a>
                                        @else
                                            <a href="/painel/user/ativar/@{{u.id}}"
                                               onclick="return confirm('Realmente deseja ativar este usuário?')"
                                               class="btn btn-success" alt="Ativar usuário"
                                               title="Ativar usuário"><span class="glyphicon glyphicon-thumbs-up"
                                                                            aria-hidden="true"></span></a>
                                        @endif
                                    @endif-->
                                </td>
                            </tr>

                    </table>

                </div>

            </div>
            <!-- /.box-body -->

        </section>


        <section class="col-md-2">

            <!-- Default box -->
            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title menu_busca">Filtro por usuário</h3>
                </div>
                <div class="box-body">

                    <div class="menu_busca">

                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscar..."
                                   aria-describedby="basic-addon2" v-model="search">
                            <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-search"
                                                                                    aria-hidden="true"></span></span>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="" v-model="nome">
                                Nome
                            </label>
                        </div>
                        <div class="checkbox disabled">
                            <label>
                                <input type="checkbox" value="" v-model="email">
                                e-mail
                            </label>
                        </div>
                        <div class="checkbox disabled">
                            <label>
                                <input type="checkbox" value="" v-model="estado">
                                Estado
                            </label>
                        </div>
                        <div class="checkbox disabled">
                            <label>
                                <input type="checkbox" value="" v-model="cidade">
                                Cidade
                            </label>
                        </div>
                        <div class="checkbox disabled">
                            <label>
                                <input type="checkbox" value="" v-model="tipo">
                                tipo
                            </label>
                        </div>
                        <div class="checkbox disabled">
                            <label>
                                <input type="checkbox" value="" v-model="status">
                                status
                            </label>
                        </div>

                    </div>

                </div>

            </div>

        </section>

    </section>

@endsection
