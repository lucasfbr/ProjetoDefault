@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            Grupo {{$role->name}}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/painel/role">Grupos</a></li>
            <li class="active">Adicionar</li>
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
                    <h3 class="box-title">Permissões Disponiveis</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="col-md-10 col-md-offset-1">
                <form role="form" method="post" action="/painel/role/create/permission/{{$role->id}}">
                    {{ csrf_field() }}
                    <div class="box-body">

                        <div class="form-group{{ $errors->has('permissoes') ? ' has-error' : '' }}">
                            <label for="permissoes">Permissões</label>
                            <select class="form-control" name="permissoes[]" id="permissoes" multiple>
                                @foreach($permissions as $permission)
                                    <option value="{{$permission->id}}">{{$permission->name}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('permissoes'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('permissoes') }}</strong>
                                </span>
                            @endif
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
