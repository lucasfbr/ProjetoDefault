@extends('painel.templates.template')

@section('content')


    <section class="content-header">
        <h1>
            Usuários
            <small>cadastrar, editar e excluir usuários</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Usuários</li>
        </ol>
    </section>

    <section class="content">


        <div class="row">

            <div class="col-md-3">
                <!-- Default box -->
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title menu_busca">Busca por usuários</h3>

                    </div>
                    <div class="box-body">

                        <div class="menu_busca">

                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Buscar..."
                                       aria-describedby="basic-addon2" v-model="search">
                                <span class="input-group-addon" id="basic-addon2"><span
                                            class="glyphicon glyphicon-search"
                                            aria-hidden="true"></span></span>
                            </div>

                            <br>

                            <div class="checkbox">
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="name" v-model="filtro">
                                    Nome
                                </label>
                            </div>

                            <div class="checkbox">
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="estado" v-model="filtro">
                                    Estado
                                </label>
                            </div>

                            <div class="checkbox">
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="cidade" v-model="filtro">
                                    Cidade
                                </label>
                            </div>

                            <div class="checkbox">
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="bairro" v-model="filtro">
                                    Bairro
                                </label>
                            </div>

                            <div class="checkbox">
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="logradouro" v-model="filtro">
                                    Endereço
                                </label>
                            </div>

                            <div class="checkbox">
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="tipo" v-model="filtro">
                                    tipo
                                </label>
                            </div>


                        </div>

                    </div>

                </div>
            </div>

            <div class="col-md-9">
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

                        <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
                            <tr>
                                <th>
                                    <i class="fa fa-fw fa-sort"></i>
                                    <a href="#" v-on:click="ordenar($event, 'name')">Nome</a>
                                </th>
                                <th>
                                    <i class="fa fa-fw fa-sort"></i>
                                    <a href="#" v-on:click="ordenar($event, 'estado')">Estado</a>
                                </th>
                                <th>
                                    <i class="fa fa-fw fa-sort"></i>
                                    <a href="#" v-on:click="ordenar($event, 'cidade')">Cidade</a>
                                </th>
                                <th>
                                    <i class="fa fa-fw fa-sort"></i>
                                    <a href="#" v-on:click="ordenar($event, 'bairro')">Bairro</a>
                                </th>
                                <th>
                                    <i class="fa fa-fw fa-sort"></i>
                                    <a href="#" v-on:click="ordenar($event, 'logradouro')">Endereço</a>
                                </th>
                                <th>
                                    <i class="fa fa-fw fa-sort"></i>
                                    <a href="#" v-on:click="ordenar($event, 'tipo')">Tipo</a>
                                </th>
                                <th>Ações</th>
                            </tr>

                            <tr v-for="u in user | filterBy search in filtro | orderBy coluna ordenacao">
                                <td width="150px">@{{u.name}}</td>
                                <td>@{{u.perfis.estado}}</td>
                                <td>@{{u.perfis.cidade}}</td>
                                <td>@{{u.perfis.bairro}}</td>
                                <td>@{{u.perfis.logradouro}}, @{{u.perfis.numero}}</td>
                                <td>@{{u.tipo}}</td>
                                <td width="180px">
                                    <a href="/painel/user/detail/@{{u.id}}" class="btn btn-sm btn-info"
                                       alt="Exibir o usuário" title="Exibir o usuário"><span
                                                class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                    <a href="/painel/user/edit/@{{u.id}}" class="btn btn-sm btn-warning"
                                       alt="Editar o usuário" title="Editar o usuário"><span
                                                class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>

                                    <a href="/painel/user/delete/@{{u.id}}"
                                       onclick="return confirm('Realmente deseja excluir este usuário?')"
                                       class="btn btn-sm btn-danger" alt="Excluir o usuário"
                                       title="Excluir o usuário"><span class="glyphicon glyphicon-remove"
                                                                       aria-hidden="true"></span></a>

                                    <span v-if="u.status == 'Ativo'">
                                    <a href="/painel/user/desativar/@{{u.id}}"
                                       onclick="return confirm('Realmente deseja desativar este usuário?')"
                                       class="btn btn-sm btn-success" alt="Desativar usuário" title="Desativar usuário">
                                        <span class="glyphicon glyphicon-thumbs-up"></span>
                                    </a>
                                    </span>

                                    <span v-else>
                                    <a href="/painel/user/ativar/@{{u.id}}"
                                       onclick="return confirm('Realmente deseja ativar este usuário?')"
                                       class="btn btn-sm btn-success" alt="Ativar usuário" title="Ativar usuário">
                                        <span class="glyphicon glyphicon-thumbs-down"></span>
                                    </a>
                                    </span>
                                </td>
                            </tr>

                        </table>

                        <div class="row">
                            <nav aria-label="Page navigation" class="text-center">
                                <ul class="pagination">
                                    <li v-bind:class="{ 'disabled' :  pagination.current === 1}">
                                        <a href="#" aria-label="Previous" v-on:click="previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>

                                    <li v-for="list in pagination.listPagination"
                                        v-bind:class="{ 'active' : pagination.current === $index + 1 }">
                                        <a href="#" v-on:click="pagePagination($event, $index)">
                                            @{{ $index + 1 }}
                                        </a>
                                    </li>
                                    <li v-bind:class="{ 'disabled' :  pagination.current === pagination.totalPages }">
                                        <a href="#" aria-label="Next" v-on:click="next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                    </div>

                </div>
            </div>
            <!-- /.box-body -->
        </div>

    </section>

@endsection
