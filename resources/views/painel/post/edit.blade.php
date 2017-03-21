@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            Posts
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/painel/post">Posts</a></li>
            <li class="active">Edit</li>
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
                @elseif(session('erro'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        {{ session('erro') }}
                    </div>
                @endif

                <div class="box-header with-border">
                    <h3 class="box-title">Edite o conteúdo do post</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="/painel/post/update/{{$post->id}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                                <label for="titulo">Título</label>
                                <input class="form-control" id="titulo" name="titulo" value="{{ $post->titulo }}"
                                       type="text">

                                @if ($errors->has('titulo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('titulo') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('conteudo') ? ' has-error' : '' }}">
                                <label>Conteúdo</label>
                                <textarea class="form-control textarea" id="conteudo" name="conteudo" rows="10">
                                    {!! $post->conteudo !!}
                                </textarea>

                                @if ($errors->has('conteudo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('conteudo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="img">Imagem</label>
                                <input type="file" id="imagem" name="imagem">

                                <p class="help-block">Selecione uma imagem para ser exibida no topo do post</p>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="Editar">
                    </div>
                </form>
            </div>

        </div>


    </section>

@endsection
