@extends('portal.templates.template')

@section('content')
    <div class="container" id="app">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Lista de usuários</div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Nome</td>
                                    <td>E-mail</td>
                                    <td>Estado</td>
                                    <td>Cidade</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="u in user">
                                    <td>@{{u.name}}</td>
                                    <td>@{{u.email}}</td>
                                    <td>@{{u.estado}}</td>
                                    <td>@{{u.cidade}}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
