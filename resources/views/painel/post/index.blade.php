@extends('painel.templates.template')

@section('content')


        <section class="content-header">
            <h1>
                Posts
                <small>{{$tipo == 'published' ? 'publicados' : 'não publicados'}}</small>
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
                        <br><br>
                    @elseif(session('erro'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ session('erro') }}
                        </div>
                        <br><br>
                    @endif

                    <a href="/painel/post/add/{{$tipo}}" class="btn btn-success">Novo Post</a>

                    <br><br>

                        @if(count($posts) > 0)
                            <div class="row">

                                @foreach($posts as $post)
                                    <div class="col-sm-6 col-md-4">
                                        <div class="thumbnail">
                                            <img class="img-responsive" src="/{{$post->imagem}}" data-holder-rendered="true">
                                            <div class="caption">
                                                <h3>{{ str_limit($post->titulo, 20)}}</h3>
                                                <hr>
                                                <p>
                                                    <a href="/painel/post/detail/{{$post->id}}/{{$tipo}}" title="Saiba mais" alt="Saiba mais" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-search"></span> Detalhes</a>
                                                    <a href="/painel/post/edit/{{$post->id}}/{{$tipo}}" class="btn btn-primary btn-xs" role="button"><span class="glyphicon glyphicon-wrench"></span> Editar</a>
                                                    <a href="/painel/post/delete/{{$post->id}}/{{$tipo}}" onclick="return confirm('Realmente deseja excluir este post?')" class="btn btn-warning btn-xs" role="button"><span class="glyphicon glyphicon-remove"></span> Excluir</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @else
                            <div class="alert alert-info text-center col-md-6 col-md-offset-3">
                                <h4>Nenhum post foi cadastrado até o momento!</h4>
                            </div>

                        @endif



                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>

@endsection
