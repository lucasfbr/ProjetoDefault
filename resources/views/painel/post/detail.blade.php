@extends('painel.templates.template')

@section('content')


        <section class="content-header">
            <h1>
                Posts
                <small>cadastrar, editar e excluir posts</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="/painel/post/{{$tipo}}">Posts</a></li>
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
                                <img class="img-circle" src="/{{$post->user->foto ? $post->user->foto : 'img/default3.png' }}" alt="User Image">
                                <span class="username"><a href="#">{{$post->user->name}}</a></span>
                                <span class="description">Publicado - {{\Carbon\Carbon::parse($post->published_at)->diffForHumans()}}</span>
                                <span class="description">Categoria - {{$post->categoria->titulo}}</span>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="col-xs-12 col-md-10 col-md-offset-1">
                                <h2>{{$post->titulo}}</h2>
                                <img class="img-responsive pad" src="/{{$post->imagem}}" alt="Photo">
                                <br>
                                <div class="text-justify">{!! $post->conteudo !!}</div>
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
