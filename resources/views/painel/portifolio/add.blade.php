@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            Portifólio
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/painel/portifolio">Portifólio</a></li>
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
                    <h3 class="box-title">Cadatre um novo portifólio</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="col-md-10 col-md-offset-1">
                <form role="form" method="post" action="/painel/portifolio/create" enctype="multipart/form-data">
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

                             <div class="form-group">
                                <label for="img">Foto</label>
                                <input type="file" id="imagem" name="imagem">

                                <p class="help-block">Selecione uma foto ou imagem para o portifolio</p>
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
