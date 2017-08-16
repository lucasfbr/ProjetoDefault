@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            Categorias
            <small>edite esta categoria</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/painel/categoria">Categorias</a></li>
            <li class="active">Editar</li>
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
                    <h3 class="box-title">Editar</h3>
                </div>

                <div class="col-md-10 col-md-offset-1">
                    <form role="form" method="post" action="/painel/categoria/update/{{$categoria->id}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                                        <label for="titulo">Título</label>
                                        <input class="form-control" id="titulo" name="titulo" value="{{ $categoria->titulo }}"
                                               type="text">

                                        @if ($errors->has('titulo'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('titulo') }}</strong>
                                            </span>
                                        @endif

                                    </div>

                                    <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
                                        <label for="descricao">Descrição</label>
                                        <textarea class="form-control" id="descricao" name="descricao" cols="10" rows="5">{{ $categoria->descricao }}</textarea>

                                        @if ($errors->has('descricao'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('descricao') }}</strong>
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
