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
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Verificamos que seu perfil não esta completo, acesse o link <a href="/painel/perfil/{{Auth::user()->id}}">Perfil</a> e complete seu cadastro <br>
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
                            <h3>0</h3>

                            <p>Clientes registrados</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="/painel/user" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>0</h3>

                            <p>Visualizações do seu perfil</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </div>
                        <a href="/painel/vendas" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>0</h3>

                            <p>Agenda de consultorias</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-book" aria-hidden="true"></i>
                        </div>
                        <a href="/painel/role" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>0</h3>

                            <p>Seguidores</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                        </div>
                        <a href="/painel/permission" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </section>

        </div>
        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->

    <!-- FIM DO CONTEUDO DAS PAGINAS -->


@endsection

