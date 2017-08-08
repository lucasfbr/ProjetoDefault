@extends('painel.templates.template')

@section('content')


        <section class="content-header">
            <h1>
                Artigos
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Artigos</li>
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

                    @if($tipo != 'lixeira')
                        <a href="/painel/artigo/add" class="btn btn-success">Novo artigo</a>
                    @else
                        <a href="/painel/artigo/limparlixeira" class="btn btn-success"  onclick="return confirm('Realmente deseja limpar a lixeira?')">Limpar lixeira</a>
                    @endif

                    <br><br>

                        @if(count($artigos) > 0)
                            <div class="row">

                                @foreach($artigos as $artigo)
                                    @can('view_artigo', $artigo)
                                    <div class="col-sm-6 col-md-4">
                                        <div class="thumbnail">
                                            <img class="img-responsive" src="/{{$artigo->imagem}}" data-holder-rendered="true">
                                            <div class="caption">
                                                <h3>{{ str_limit($artigo->titulo, 15)}}</h3>
                                                <h5 class="text-info">Por {{$artigo->user->name}}</h5>
                                                <h5 class="text-info">criado em: {{\Carbon\Carbon::parse($artigo->created_at)->format('d/m/Y')}}</h5>
                                                <h5 class="text-info">Agendado para: {{\Carbon\Carbon::parse($artigo->published_at)->format('d/m/Y')}}</h5>
                                                <p>
                                                    @if($tipo != 'lixeira')
                                                        <a href="/painel/artigo/detail/{{$artigo->id}}" title="Saiba mais" alt="Saiba mais" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-search"></span> Detalhes</a>
                                                        <a href="/painel/artigo/edit/{{$artigo->id}}" class="btn btn-primary btn-xs" role="button"><span class="glyphicon glyphicon-wrench"></span> Editar</a>
                                                        <a href="/painel/artigo/delete/{{$artigo->id}}" onclick="return confirm('Realmente deseja mover este artigo para a lixeira?')" class="btn btn-warning btn-xs" role="button"><span class="glyphicon glyphicon-trash"></span> Lixeira</a>
                                                    @else
                                                        <a href="/painel/artigo/restore/{{$artigo->id}}" onclick="return confirm('Realmente deseja restaurar este artigo?')" class="btn btn-warning btn-xs" role="button"><span class="glyphicon glyphicon-trash"></span> Restaurar</a>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endcan
                                @endforeach

                            </div>
                        @else
                            <div class="alert alert-info text-center col-md-10 col-md-offset-1">
                                <h4>Nenhum artigo até o momento!</h4>
                            </div>

                        @endif
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {!! $artigos->render() !!}
                </div>
            </div>
            <!-- /.box -->

        </section>

@endsection
