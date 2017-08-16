@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            Grupos
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/painel/permissions">Permissões</a></li>
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
                    <h3 class="box-title">Nova Permissão</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="col-md-10 col-md-offset-1">
                <form role="form" method="post" action="/painel/permission/create">
                    {{ csrf_field() }}
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-12 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Nome</label>
                                <input class="form-control" id="name" name="name" type="text"
                                       value="{{ old('name') }}"
                                       autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group{{ $errors->has('descricao') ? ' has-error' : '' }}">
                                    <label>Descrição</label>
                                    <textarea class="form-control" id="descricao" name="descricao" rows="10"
                                              placeholder="Descrição da permissão ...">{{ old('descricao') }}</textarea>

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
                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                    </div>
                </form>
                </div>
            </div>

        </div>


    </section>

@endsection
