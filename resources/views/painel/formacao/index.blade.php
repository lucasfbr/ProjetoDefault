@extends('painel.templates.template')

@section('content')


    <section class="content-header">
        <h1>
            Formação
            <small>cadastrar, editar e excluir formações</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Formações</li>
        </ol>
    </section>

    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">

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


                    <a href="/painel/formacao/add/{{$usuarioId}}" class="btn btn-success">Nova Formação</a>

                    <br><br>

                    @if(count($formacoes) > 0)

                    <table class="table table-bordered table-striped table-hover table-condensed table-responsive">

                        <tr>
                            <th>Titulo</th>
                            <th>Conteúdo</th>
                            <th>Link</th>
                            <th>Data de conclusão</th>
                            <th>Ações</th>
                        </tr>

                        @foreach($formacoes as $formacao)

                        <tr>
                            <td>{{$formacao->titulo}}</td>
                            <td>{{$formacao->conteudo}}</td>
                            <td>{{$formacao->link}}</td>
                            <td>{{$formacao->dataFormacao}}</td>
                            <td width="95px">

                                <a href="/painel/formacao/edit/{{$formacao->id}}" class="btn btn-warning"
                                   alt="Editar formação" title="Editar formação"><span
                                            class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>

                                <a href="/painel/formacao/delete/{{$formacao->id}}"
                                   onclick="return confirm('Realmente deseja excluir este registro?')"
                                   class="btn btn-danger" alt="Excluir o usuário"
                                   title="Excluir a formação"><span class="glyphicon glyphicon-remove"
                                                                   aria-hidden="true"></span></a>
                            </td>
                        </tr>

                        @endforeach

                    </table>
                    @else
                        <div class="row">
                            <div class="alert alert-info text-center col-md-6 col-md-offset-3">
                                <h4>Nenhum registro cadastrado até o momento!</h4>
                            </div>
                        </div>
                    @endif



            </div>

        </div>
        <!-- /.box-body -->

    </section>

@endsection
