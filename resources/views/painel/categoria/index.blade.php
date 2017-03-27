@extends('painel.templates.template')

@section('content')


        <section class="content-header">
            <h1>
                Categorias
                <small>crie suas categorias para organizar os posts</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Categorias</li>
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
                        <br><br>
                    @elseif(session('erro'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ session('erro') }}
                        </div>
                        <br><br>
                    @endif

                    <a href="/painel/categoria/add" class="btn btn-success">Nova Categoria</a>

                    <br><br>

                        @if(count($categorias) > 0)



                                    <table class="table table-striped table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Autor</th>
                                                <th>Criada em</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($categorias as $cat)
                                                <tr>
                                                    <td>{{$cat->titulo}}</td>
                                                    <td>{{$cat->user->name}}</td>
                                                    <td>{{\Carbon\Carbon::parse($cat->created_at)->format('d/m/Y')}}</td>
                                                    <td>
                                                        <a href="/painel/categoria/edit/{{$cat->id}}" class="btn btn-warning"
                                                           alt="Editar a categoria" title="Editar a categoria"><span
                                                                    class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>

                                                        <a href="/painel/categoria/delete/{{$cat->id}}"
                                                           onclick="return confirm('Realmente deseja excluir esta categoria?')"
                                                           class="btn btn-danger" alt="Excluir a categoria"
                                                           title="Excluir a categoria"><span class="glyphicon glyphicon-remove"
                                                                                           aria-hidden="true"></span></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                        @else
                            <div class="alert alert-info text-center col-md-10 col-md-offset-1">
                                <h4>Nenhuma categoria cadastrada até o momento</h4>
                            </div>

                        @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {!! $categorias->render() !!}
                </div>
            </div>
            <!-- /.box -->

        </section>

@endsection
