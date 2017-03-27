@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            {{$role->name}}
            <small>permissões deste usuário</small>
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

                        @if($role->name != 'adm')
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                                @forelse($permissions as $permission)
                                <tr>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->label}}</td>
                                    <td>
                                        <a href="/painel/role/delete" class="btn btn-danger" title="Excluir função" alt="Cadastrar uma nova funçã"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                         @else
                                <div class="alert alert-success text-center col-md-10 col-md-offset-1">
                                    <h4>O usuário "adm" tem acesso liberado em todo o sistema! </h4>
                                </div>

                            @endif
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>

            </div>

        </div>
        <!-- /.box -->

    </section>

@endsection
