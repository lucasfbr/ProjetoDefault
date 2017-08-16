@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            Serviços
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/painel/service"><a href="/painel/service">serviços</a></li>
            <li class="active">Detalhes</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-md-3">

                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="/{{$servico->imagem}}" title="{{$servico->titulo}}" alt="{{$servico->titulo}}">

                        <h3 class="profile-username text-center">{{$servico->titulo}}</h3>

                    </div>
                    <!-- /.box-body -->
                </div>

            </div>

            <div class="col-md-9">

                <div class="box box-primary">
                    <div class="box-body box-profile">

                        <div class="page-header">
                            <h1>{{$servico->titulo}} <small>resumo e texto completo</small></h1>
                        </div>

                        <h4>Resumo</h4>
                        <p>{{$servico->resumo}}</p>
                        <hr>
                        <h4>Texto completo</h4>
                        <p>{{ $servico->texto }}</p>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>

        </div>

    </section>



@endsection