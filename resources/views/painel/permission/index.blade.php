@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            Permissões
            <small>Gerencie as permissões dos sistema</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Permissões</li>

        </ol>
    </section>

    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-body">

                <div class="row">
                    <div class="col-xs-12">

                        <div class="box-header">

                            @if (session('sucesso'))
                                <div class="alert alert-success alert-dismissible" permission="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    {{ session('sucesso') }}
                                </div>
                                <br/>
                            @elseif(session('erro'))
                                <div class="alert alert-danger alert-dismissible" permission="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    {{ session('erro') }}
                                </div>
                                <br/>
                            @endif


                            <a href="/painel/permission/add" class="btn btn-primary" title="Cadastrar uma nova permissão" alt="Cadastrar uma nova permissão"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                <br><br>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody><tr>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                                @forelse($permissions as $permission)
                                <tr>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->label}}</td>
                                    <td>
                                        <a href="/painel/permission/edit/{{$permission->id}}" class="btn btn-warning" title="Editar função" alt="Cadastrar uma nova funçã"><i class="fa fa-wrench" aria-hidden="true"></i></a>
                                        <a href="/painel/permission/delete/{{$permission->id}}" onclick="return confirm('Realmente deseja remover esta permissão?')" class="btn btn-danger" title="Excluir permissão" alt="Excluir permissão"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="90">
                                            <h4 class="text-center">Nenhuma permissão cadastrada até o momento!</h4>
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
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>

@endsection
