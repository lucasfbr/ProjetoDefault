@extends('painel.templates.template')

@section('content')


    <section class="content-header">
        <h1>
            Posts
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/painel/post">Posts</li>
            <li class="active">Cadastro</li>
        </ol>
    </section>

    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">


                <div class="box-header with-border">
                    <h3 class="box-title">Edite o post</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="/painel/post/update/{{ $post->id }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input class="form-control" id="titulo" name="titulo" type="text" value="{{$post->titulo}}">
                        </div>
                        <div class="form-group">
                            <label>Conteúdo</label>
                            <textarea class="form-control" rows="3" id="conteudo" name="conteudo">{{$post->conteudo}}</textarea>
                        </div>
                    </div>

                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                    </div>
                </form>
            </div>

        </div>



    </section>

@endsection
