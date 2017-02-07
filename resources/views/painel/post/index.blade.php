@extends('painel.templates.template')

@section('content')


        <section class="content-header">
            <h1>
                Posts
                <small>cadastrar, editar e excluir posts</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Posts</li>
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
                    @elseif(session('erro'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ session('erro') }}
                        </div>
                    @endif

                    <br /><br />

                    <a href="/painel/post/add" class="btn btn-success">Novo Post</a>

                    <table class="table table-bordered table-striped table-hover table-condensed">
                        <tr>
                            <th>Titulo</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>

                        @forelse($posts as $post)
                            <tr>
                                <td width="150px">{{$post->titulo}}</td>
                                <td>{{$post->conteudo}}</td>
                                <td width="150px">
                                    <a href="/painel/post/detail/{{$post->id}}" class="btn btn-info" alt="Exibir o post" title="Exibir o post"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                    <a href="/painel/post/edit/{{$post->id}}" class="btn btn-warning" alt="Editar o post" title="Editar o post"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                    <a href="/painel/post/delete/{{$post->id}}" class="btn btn-danger" alt="Excluir o post" title="Excluir o post"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="90"> Nenhum post encontrado </td>
                            </tr>
                        @endforelse
                    </table>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>

@endsection
