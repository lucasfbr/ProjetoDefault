@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            Usuários
            <small>Gerencie os acessos dos usuários</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="#">Usuários</a></li>
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
                                <tbody><tr>
                                    <th>Nome</th>
                                    <th>Ações</th>
                                </tr>
                                @forelse($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        <a href="/painel/user/role/show/{{$user->id}}" class="btn btn-success" title="Visualizar grupos deste usuário" alt="Visualizar grupos deste usuário"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="90">
                                            <h4 class="text-center">Nenhuma usuário cadastrada até o momento!</h4>
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
