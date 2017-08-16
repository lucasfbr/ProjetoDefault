@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            Quem somos
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/painel/quemsomos">Quem somos</a></li>
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
                    <h3 class="box-title">Cadatre um novo registro</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="col-md-10 col-md-offset-1">
                <form role="form" method="post" action="/painel/quemsomos/create" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">

                            <div class="form-group{{ $errors->has('titulo_sobre') ? ' has-error' : '' }}">
                                <label for="titulo_sobre">Titulo Sobre a empresa</label>
                                <input class="form-control" id="titulo_sobre" name="titulo_sobre" type="text" value="{{ old('titulo_sobre') }}"
                                       autofocus>
                                @if ($errors->has('titulo_sobre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('titulo_sobre') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('texto_sobre') ? ' has-error' : '' }}">
                                <label>Texto sobre a empresa</label>

                                <textarea class="form-control" id="texto_sobre" name="texto_sobre" cols="10" rows="5">{{ old('texto_sobre') }}</textarea>

                                @if ($errors->has('texto_sobre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('texto_sobre') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="imagem_sobre">Foto sobre a empresa</label>
                                <input type="file" id="imagem_sobre" name="imagem_sobre">

                                <p class="help-block">Selecione uma foto ou imagem sobre a empresa</p>
                            </div>

                            <div class="form-group{{ $errors->has('titulo_missao') ? ' has-error' : '' }}">
                                <label for="titulo_missao">Titulo Sobre a missão</label>
                                <input class="form-control" id="titulo_missao" name="titulo_missao" type="text" value="{{ old('titulo_missao') }}"
                                       autofocus>
                                @if ($errors->has('titulo_missao'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('titulo_missao') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('texto_missao') ? ' has-error' : '' }}">
                                <label>Texto sobre a missão</label>

                                <textarea class="form-control" id="texto_missao" name="texto_missao" cols="10" rows="5">{{ old('texto_missao') }}</textarea>

                                @if ($errors->has('texto_missao'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('texto_missao') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="imagem_sobre">Foto sobre a missão</label>
                                <input type="file" id="imagem_missao" name="imagem_missao">

                                <p class="help-block">Selecione uma foto ou imagem sobre a missão da empresa</p>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="status" name="status" value="1"><strong>Exibir na página principal</strong>
                                </label>
                            </div>

                    </div>

                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>

@endsection
