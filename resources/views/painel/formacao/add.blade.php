@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            Formação
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/painel/formacao/{{$user_id}}">Formação</a></li>
            <li class="active">Cadastro</li>
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
                    <h3 class="box-title">Cadatre uma nova formação</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="/painel/formacao/create" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">

                            <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                                <label for="titulo">Titulo</label>
                                <input class="form-control" id="titulo" name="titulo" type="text" value="{{ old('titulo') }}"
                                       autofocus>
                                @if ($errors->has('titulo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('titulo') }}</strong>
                                    </span>
                                @endif
                            </div>

                        <div class="form-group{{ $errors->has('conteudo') ? ' has-error' : '' }}">
                            <label for="conteudo">Conteudo</label>
                            <textarea class="form-control" id="conteudo" name="conteudo" cols="10" rows="5">{{ old('conteudo') }}</textarea>
                            @if ($errors->has('conteudo'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('conteudo') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="link">Link</label>
                            <input class="form-control" id="link" name="link" type="text" value="{{ old('link') }}">
                            <p>Link no formaro http://link.com.br</p>
                        </div>


                        <div class="form-group">
                            <label for="dataFormacao">Data de conclusão</label>
                            <input class="form-control"
                                   id="dataFormacao"
                                   name="dataFormacao"
                                   type="text"
                                   value="{{ old('dataFormacao') }}"
                                   data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                        </div>

                    </div>

                    <input type="hidden" name="user_id" id="user_id" value="{{$user_id}}">

                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
