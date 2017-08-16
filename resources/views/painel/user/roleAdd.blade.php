@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            {{$user->name}}
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="/painel/user/role">Grupos</a></li>
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
                    <h3 class="box-title">Vincule o usuário {{$user->name}} a algum grupo </h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="col-md-10 col-md-offset-1">
                    <form name="form-role" id="form-role" method="post" action="/painel/user/role/create/{{$user->id}}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('grupo') ? ' has-error' : '' }}">
                            <label for="grupo">Grupos</label>
                            <select class="form-control" name="grupo" id="grupo">
                                <option value="">Selecione um grupo</option>
                                @forelse($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @empty
                                @endforelse
                            </select>

                            @if ($errors->has('grupo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('grupo') }}</strong>
                                </span>
                            @endif
                        </div>

                        <input type="submit" class="btn btn-primary" value="Salvar">
                    </form>
                </div>
            </div>

        </div>


    </section>

@endsection
