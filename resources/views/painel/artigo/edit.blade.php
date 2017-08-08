@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            Artigos
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/painel/artigo/">Artigos</a></li>
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
                    <h3 class="box-title">Edite o conteúdo do artigo</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="col-md-10 col-md-offset-1">
                <form role="form" method="post" action="/painel/artigo/update/{{$artigo->id}}"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('categoria_id') ? ' has-error' : '' }}">
                                    <label for="categoria_id">Categoria</label>
                                    <select class="form-control" name="categoria_id" id="categoria_id">
                                        @foreach($categorias as $cat)
                                            <option value="{{$cat->id}}" {{$cat->id == $artigo->categoria->id ? 'selected' : ''}}>{{$cat->titulo}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('categoria_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('categoria_id') }}</strong>
                                        </span>
                                    @endif

                                </div>
                                <p class="text-info"><a href="/painel/categoria">[+] Add categoria</a></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                                    <label for="titulo">Título</label>
                                    <input class="form-control" id="titulo" name="titulo" value="{{ $artigo->titulo }}"
                                           type="text">

                                    @if ($errors->has('titulo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('titulo') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('conteudo') ? ' has-error' : '' }}">
                                    <label>Conteúdo</label>
                                    <textarea class="form-control textarea" id="conteudo" name="conteudo" rows="10">
                                    {!! $artigo->conteudo !!}
                                </textarea>

                                    @if ($errors->has('conteudo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('conteudo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="img">Imagem</label>
                                    <input type="file" id="imagem" name="imagem">

                                    <p class="help-block">Selecione uma imagem para ser exibida no topo do artigo</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('published_at') ? ' has-error' : '' }}">
                                    <label for="published_at">Data de publicação</label>
                                    <div class='input-group date' id='datetimepicker2'>
                                        <input class="form-control" id="published_at" name="published_at"
                                               value="{{ $artigo->published_at }}"
                                               type="text" data-inputmask="'alias': 'datetime'" data-mask=""/>
                                        <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>

                                    @if ($errors->has('published_at'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('published_at') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="Editar">
                    </div>
                </form>
                </div>
            </div>

        </div>


    </section>

@endsection
