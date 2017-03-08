@extends('painel.templates.template')

@section('content')


    <section class="content-header">
        <h1>
            Portifólio
            <small>cadastrar, editar e excluir</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Portifólio</li>
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


                <a href="/painel/portifolio/add" class="btn btn-success">Novo Portifólio</a>

                <br><br>

                    @if(count($portifolio) > 0)
                    <div class="row">

                        @foreach($portifolio as $port)
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                                <img alt="100%x200" data-src="holder.js/100%x200" style="height: 200px; width: 100%; display: block;" src="/{{$port->imagem}}" data-holder-rendered="true">
                                <div class="caption">
                                    <h3>{{ str_limit($port->titulo, 20)}}</h3>
                                    <p><a href="/painel/portifolio/edit/{{$port->id}}" class="btn btn-primary" role="button">Editar</a> <a href="/painel/portifolio/delete/{{$port->id}}" onclick="return confirm('Realmente deseja excluir este registro?')" class="btn btn-default" role="button">Excluir</a></p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    @else

                            <div class="alert alert-info text-center col-md-6 col-md-offset-3">
                                <h4>Nenhum portifólio foi cadastrado até o momento!</h4>
                            </div>

                    @endif


            </div>

        </div>
        <!-- /.box-body -->

    </section>

@endsection
