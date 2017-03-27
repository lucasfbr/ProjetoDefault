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

                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
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
                                        <a href="#" class="btn btn-danger" title="Excluir função" alt="Cadastrar uma nova funçã"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
