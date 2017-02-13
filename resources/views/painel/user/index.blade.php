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

        <!-- Default box -->
        <div class="box">

            <div class="box-body">

                @if (session('sucesso'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session('sucesso') }}
                    </div>
                    <br />
                @elseif(session('erro'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session('erro') }}
                    </div>
                    <br />
                @endif

                <a href="/painel/user/add" class="btn btn-success">Novo Usuário</a>
                <br /><br />

                <table class="table table-bordered table-striped table-hover table-condensed">
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Tipo</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>

                    @forelse($users as $user)
                        <tr>
                            <td width="150px">{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->tipo}}</td>
                            <td>{{$user->status}}</td>
                            <td width="180px">
                                <a href="/painel/user/detail/{{$user->id}}" class="btn btn-info" alt="Exibir o usuário" title="Exibir o usuário"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                <a href="/painel/user/edit/{{$user->id}}" class="btn btn-warning" alt="Editar o usuário" title="Editar o usuário"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                <a href="/painel/user/delete/{{$user->id}}" onclick="return confirm('Realmente deseja excluir este usuário?')" class="btn btn-danger" alt="Excluir o usuário" title="Excluir o usuário"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                @if(($user->tipo == 'Consultor') || ($user->tipo == 'Administrador'))
                                    @if($user->status == 'Ativo')
                                        <a href="/painel/user/desativar/{{$user->id}}" onclick="return confirm('Realmente deseja desativar este usuário?')" class="btn btn-success" alt="Desativar usuário" title="Desativar usuário"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></a>
                                    @else
                                        <a href="/painel/user/ativar/{{$user->id}}" onclick="return confirm('Realmente deseja ativar este usuário?')" class="btn btn-success" alt="Ativar usuário" title="Ativar usuário"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="90"> Nenhum usuário cadastrado</td>
                        </tr>
                    @endforelse
                </table>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>

@endsection
