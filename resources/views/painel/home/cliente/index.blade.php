@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            Painel de controle do usuário
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Painel de controle</li>
        </ol>
    </section>

    <!-- INICIO DO CONTEUDO DAS PAGINAS -->

    <!-- Main content -->
    <section class="content">


        @if (Auth::user()->perfil == 'Incompleto')
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                Verificamos que seu perfil não esta completo, acesse o link <a href="/painel/perfil ">Perfil</a> e
                complete seu cadastro <br>
            </div>
            <br/>
    @endif


    <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">


                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{totalConsultores()}}</h3>

                            <p>Consultores</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users" aria-hidden="true"></i>
                        </div>
                        <a href="/painel/user" class="small-box-footer">Mais informações <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>0</h3>

                            <p>Consultores 5 estrelas</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                        <a href="/painel/vendas" class="small-box-footer">Mais informações <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>0</h3>

                            <p>Mensagens para você</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </div>
                        <a href="/painel/role" class="small-box-footer">Mais informações <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>0</h3>

                            <p>Tutoriais</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-th-list" aria-hidden="true"></i>
                        </div>
                        <a href="/painel/permission" class="small-box-footer">Mais informações <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>


            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <section class="col-xs-12">

                <!-- quick email widget -->
                <div class="box">
                    <div class="box-header">

                        <h3 class="box-title">Bem vindo ao {{ info_sistem()->titulo != '' ? info_sistem()->titulo : 'Titulo do sistema' }}</h3>
                        <p>Abaixo seguem nossas especialidades</p>

                    </div>
                    <div class="box-body">

                        @if(count($servicos) > 0)

                                @foreach($servicos as $servico)
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <div class="thumbnail">
                                            <img alt="100%x200" data-src="holder.js/100%x200" style="height: 200px; width: 100%; display: block;" src="/{{$servico->imagem}}" data-holder-rendered="true">
                                            <div class="caption">
                                                <h3 class="text-center">{{$servico->titulo}}</h3>
                                                <p class="text-center">{{ $servico->resumo }}</p>
                                                <p class="text-center"><a href="#" class="btn btn-primary" role="button">Consultores disponíveis</a></p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                        @else
                            <div class="alert alert-info text-center col-md-10 col-md-offset-1">
                                <h4>Nenhum serviço cadastrado até o momento!</h4>
                            </div>

                        @endif

                    </div>
                </div>

            </section>
        </div>


    </section>
    <!-- /.content -->

    <!-- FIM DO CONTEUDO DAS PAGINAS -->


@endsection

