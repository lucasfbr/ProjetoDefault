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

            <div class="col-md-4">

                <div class="box box-primary">
                    <div class="box-body box-profile">


                            <h3>Outros Serviços</h3>

                            <hr>

                        <div class="list-group">

                            @foreach($todosServicos as $serv)

                                <a href="/painel/service/detail/{{$serv->id}}" class="list-group-item"><h4>{{$serv->titulo}}</h4></a>

                            @endforeach

                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>

            </div>

            <div class="col-md-8">

                <div class="box box-primary">
                    <div class="box-body box-profile">

                        <div class="page-header">
                            <h1>{{$servico->titulo}}</h1>
                        </div>



                        @if($servico->imagem_descricao)
                        <img src="/{{$servico->imagem_descricao}}" class="img-responsive" title="{{$servico->titulo}}" alt="{{$servico->titulo}}">
                        @endif

                        <br>
                        <br>

                        {!! $servico->texto !!}

                    </div>
                    <!-- /.box-body -->
                </div>

            </div>

        </div>

    </section>



@endsection