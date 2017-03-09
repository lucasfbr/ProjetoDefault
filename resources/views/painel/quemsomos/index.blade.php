@extends('painel.templates.template')

@section('content')


    <section class="content-header">
        <h1>
            Quem somos
            <small>cadastrar, editar e excluir</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Quem somos</li>
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


                <a href="/painel/quemsomos/add" class="btn btn-success">Novo Registro</a>

                <br><br>

                    @if(count($quemsomos) > 0)
                    <div class="row">

                        @foreach($quemsomos as $quem)
                        <div class="col-sm-4 col-md-3">
                            <div class="thumbnail">
                                <img alt="100%x200" data-src="holder.js/100%x200" style="height: 200px; width: 100%; display: block;" src="/{{$quem->imagem_sobre}}" data-holder-rendered="true">
                                <div class="caption">
                                    <h3>{{ str_limit($quem->titulo_sobre, 20)}}</h3>
                                    <p>{{ str_limit($quem->texto_sobre, 130) }} <a href="/painel/quemsomos/detail/{{$quem->id}}" title="Saiba mais" alt="Saiba mais">[<span class="glyphicon glyphicon-plus"></span>]</a></p>
                                    <p><a href="/painel/quemsomos/edit/{{$quem->id}}" class="btn btn-primary" role="button">Editar</a> <a href="/painel/quemsomos/delete/{{$quem->id}}" onclick="return confirm('Realmente deseja excluir este registro?')" class="btn btn-default" role="button">Excluir</a></p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    @else
                        <div class="alert alert-info text-center col-md-6 col-md-offset-3">
                            <h4>Nenhum registro até o momento!</h4>
                        </div>

                    @endif

            </div>

        </div>
        <!-- /.box-body -->

    </section>

@endsection
