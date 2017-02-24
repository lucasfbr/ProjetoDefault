@extends('portal.templates.template')

@section('content')
    <div class="container" id="app">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <p>
                    Mussum Ipsum, cacilds vidis litro abertis. Per aumento de cachacis, eu reclamis. Mais vale um bebadis conhecidiss, que um alcoolatra anonimiss. Interagi no mé, cursus quis, vehicula ac nisi. Admodum accumsan disputationi eu sit. Vide electram sadipscing et per.

                    Sapien in monti palavris qui num significa nadis i pareci latim. Quem num gosta di mé, boa gente num é. Praesent vel viverra nisi. Mauris aliquet nunc non turpis scelerisque, eget. Nec orci ornare consequat. Praesent lacinia ultrices consectetur. Sed non ipsum felis.
                </p>
            </div>

            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <div class="panel-heading">Lista de usuários - @{{ nome }}</div>

                    <div class="panel-body">

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Buscar" v-model="search">
                        </div>

                        <table class="table">
                            <thead>
                            <tr>
                                <td>
                                    <i class="fa fa-fw fa-sort"
                                       v-bind:class="{'fa-sort-amount-asc' : coluna === 'name' && ordenacao === 1, 'fa-sort-amount-desc' : coluna === 'name' && ordenacao === -1}"></i>
                                    <a href="#" v-on:click="ordenar($event, 'name')">Nome</a>
                                </td>
                                <td>
                                    <i class="fa fa-fw fa-sort"
                                       v-bind:class="{'fa-sort-amount-asc' : coluna === 'email' && ordenacao === 1, 'fa-sort-amount-desc' : coluna === 'email' && ordenacao === -1}"></i>
                                    <a href="#" v-on:click="ordenar($event, 'email')">E-mail</a>
                                </td>
                                <td>
                                    <i class="fa fa-fw fa-sort"
                                       v-bind:class="{'fa-sort-amount-asc' : coluna === 'estado' && ordenacao === 1, 'fa-sort-amount-desc' : coluna === 'estado' && ordenacao === -1}"></i>
                                    <a href="#" v-on:click="ordenar($event, 'estado')">Estado</a>
                                </td>
                                <td>
                                    <i class="fa fa-fw fa-sort"
                                       v-bind:class="{'fa-sort-amount-asc' : coluna === 'cidade' && ordenacao === 1, 'fa-sort-amount-desc' : coluna === 'cidade' && ordenacao === -1}"></i>
                                    <a href="#" v-on:click="ordenar($event, 'cidade')">Cidade</a>
                                </td>
                                <td>
                                    Data
                                </td>
                                <td>
                                    Ações
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="u in user | filterBy search | orderBy coluna ordenacao">
                                <td>@{{u.name}}</td>
                                <td>@{{u.email}}</td>
                                <td>@{{u.estado}}</td>
                                <td>@{{u.cidade}}</td>
                                <td>@{{u.created_at | formatDate }}</td>
                                <td width="120px">
                                    <button class="btn btn-primary">Edit</button>
                                    <button class="btn btn-warning">Del</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
