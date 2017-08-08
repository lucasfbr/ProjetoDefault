@extends('painel.templates.template')

@section('content')


        <section class="content-header">
            <h1>
                Artigos
                <small>Detalhes do artigo</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="/painel/artigo">Artigos</a></li>
                <li class="active">Detalhes</li>
            </ol>
        </section>

        <section class="content">

            <!-- Default box -->
            <div class="box">

                <div class="box-body">

                    <div class="box box-widget col-md-9">
                        <div class="box-header with-border">
                            <div class="user-block">
                                <img class="img-circle" src="/{{$artigo->user->foto ? $artigo->user->foto : 'img/default3.png' }}" alt="User Image">
                                <span class="username"><a href="#">{{$artigo->user->name}}</a></span>
                                <span class="description">Publicado - {{\Carbon\Carbon::parse($artigo->published_at)->diffForHumans()}}</span>
                                <span class="description">Categoria - {{$artigo->categoria->titulo}}</span>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="col-xs-12 col-md-10 col-md-offset-1">
                                <h2>{{$artigo->titulo}}</h2>
                                <img class="img-responsive pad" src="/{{$artigo->imagem}}" alt="Photo">
                                <br>
                                <div class="text-justify">{!! $artigo->conteudo !!}</div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>




                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>

@endsection
