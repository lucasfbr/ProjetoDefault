@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            Quem somos
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/painel/service"><a href="/painel/quemsomos">Quem somos</a></li>
            <li class="active">Detalhes</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">

                <div class="box box-primary">
                    <div class="box-body box-profile">

                        <div class="page-header">
                            <h1>Detalhes <small>titulo e texto completo</small></h1>
                        </div>

                        <div class="col-md-4">

                            <h4>Titulo sobre a empresa</h4>
                            <p>{{$quemsomos->titulo_sobre}}</p>
                            <hr>
                            <h4>Texto sobre a empresa</h4>
                            <p class="text-right">{{ $quemsomos->texto_sobre }}</p>

                        </div>

                        <div class="col-md-2">
                            <img class="img-responsive img-rounded" src="/{{$quemsomos->imagem_sobre}}">
                        </div>

                        <div class="col-md-2">
                            <img class="img-responsive img-rounded" src="/{{$quemsomos->imagem_missao}}">
                        </div>

                        <div class="col-md-4">

                            <h4>Titulo sobre a missão</h4>
                            <p>{{$quemsomos->titulo_missao}}</p>
                            <hr>
                            <h4>Texto sobre a missão</h4>
                            <p class="text-left">{{ $quemsomos->texto_missao }}</p>

                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>


        </div>

    </section>



@endsection