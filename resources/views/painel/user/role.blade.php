@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            {{$user->name}}
            <small>grupos de acesso do usuário</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/painel/role">Funções</a></li>
            <li class="active"><a href="#">Detalhes</a></li>
        </ol>
    </section>

    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">

                <div class="row">
                    <div class="col-xs-12">

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


                        <!-- /.box-header -->
                        <div class="box-body  no-padding">

                            <a href="/painel/user/role/add/{{$user->id}}" title="Adicionar grupo ao usuário" alt="Adicionar grupo ao usuário" class="btn btn-primary">
                                <i class="fa fa-plus" aria-hidden="true"></i></a>
                            <br><br>

                            <table class="table table-responsive table-hover table-striped">
                                <tbody>
                                <tr>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                                @forelse($roles as $role)
                                    <tr>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->label}}</td>
                                        <td>
                                            <a href="/painel/user/role/delete/{{$user->id}}/{{$role->id}}"
                                               onclick="return confirm('Realmente deseja remover este usuário do grupo?')"
                                               class="btn btn-danger"
                                               title="Remover usuário deste grupo"
                                               alt="Remover usuário deste grupo">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="90">
                                            <h4 class="text-center">Nenhuma função cadastrada até o momento!</h4>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>

            </div>

        </div>
        <!-- /.box -->

    </section>

@endsection
