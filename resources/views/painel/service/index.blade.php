@extends('painel.templates.template')

@section('content')


    <section class="content-header">
        <h1>
            Serviços
            <small>cadastrar, editar e excluir serviços</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Serviços</li>
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
                    <br/>
                @elseif(session('erro'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        {{ session('erro') }}
                    </div>
                    <br/>
                @endif


                <a href="/painel/service/add" class="btn btn-success">Novo Serviço</a>

                <br><br>

                    <div class="row">

                        @foreach($servicos as $servico)
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                                <img src="/{{$servico->imagem}}" alt="..." class="img-responsive img-rounded">
                                <div class="caption">
                                    <h3>{{$servico->titulo}}</h3>
                                    {!! $servico->texto !!}
                                    <p><a href="#" class="btn btn-primary" role="button">Editar</a> <a href="/painel/service/delete/{{$servico->id}}" class="btn btn-default" role="button">Excluir</a></p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

            </div>

        </div>
        <!-- /.box-body -->

    </section>

@endsection
