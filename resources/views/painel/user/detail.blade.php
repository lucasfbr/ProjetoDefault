@extends('painel.templates.template')

@section('content')


        <section class="content-header">
            <h1>
                Usuários
                <small>detalhes do usuário</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="/painel/user">Usuários</a></li>
                <li class="active">Detalhes</li>
            </ol>
        </section>

        <section class="content">

            <!-- Default box -->
            <div class="box">

                <div class="box-body">

                    <div class="row">

                        <div class="col-md-12">
                            <!-- Widget: user widget style 1 -->
                            <div class="box box-widget widget-user-2">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-yellow">
                                    <div class="widget-user-image">
                                        <img class="img-circle" src="/{{$user->foto ? $user->foto : 'img/default3.png'}}" alt="User Avatar">
                                    </div>
                                    <!-- /.widget-user-image -->
                                    <h3 class="widget-user-username">{{ $user->name }}</h3>
                                    <h5 class="widget-user-desc">{{ $perfil ? $perfil->profissao : ''}}</h5>
                                    <h5 class="widget-user-desc">{{ $perfil ? $perfil->empresa : '' }}</h5>
                                </div>



                                    <div class="box-header with-border">
                                        <h3 class="box-title">Sobre mim</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body col-md-6">
                                        <strong><i class="fa fa-book margin-r-5"></i>Formação</strong>

                                        <p class="text-muted">
                                            {{-- $user->formacao --}}
                                        </p>

                                        <hr>

                                        <strong><i class="fa fa-map-marker margin-r-5"></i>Localização</strong>

                                        <p class="text-muted">{{ $perfil ? $perfil->logradouro : ''}}, {{ $perfil ? $perfil->numero : ''}}, {{ $perfil ? $perfil->bairro : ''}}, {{ $perfil ? $perfil->cidade : '' }}, {{ $perfil ? $perfil->estado : '' }}</p>

                                        <hr>

                                        <strong><i class="fa fa-pencil margin-r-5"></i>Habilidades</strong>

                                        <p>

                                        </p>

                                        <hr>

                                        <strong><i class="fa fa-at margin-r-5"></i> E-mail</strong>

                                        <p>{{ $user->email }}</p>
                                    </div>
                                    <div class="box-body col-md-6">
                                        <strong><i class="fa fa-phone margin-r-5"></i>Telefone</strong>

                                        <p class="text-muted">
                                            {{ $perfil ? $perfil->fone : '' }}
                                        </p>

                                        <hr>

                                        <strong><i class="fa fa-mobile margin-r-5"></i>Celular</strong>

                                        <p class="text-muted">{{ $perfil ? $perfil->celular : '' }}</p>

                                        <hr>

                                        <strong><i class="fa fa-venus-mars margin-r-5"></i>Sexo</strong>

                                        <p>{{ $perfil ? genero($perfil->sexo) : '' }}</p>

                                        <hr>

                                        <strong><i class="fa fa-calendar margin-r-5"></i>Cadastrado(a) desde:</strong>

                                        <p>{{ $user->created_at }}</p>

                                        <hr>

                                    </div>
                                    <!-- /.box-body -->

                                    <div  class="box-body col-md-12">
                                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Notas</strong>

                                        <p>{{-- $user->notas --}}</p>
                                    </div>

                                @if($user->tipo == 'Consultor')

                                <div class="box-footer no-padding col-md-12">
                                    <ul class="nav nav-stacked">
                                        <li><a href="#">Projetos <span class="pull-right badge bg-blue">31</span></a></li>
                                        <li><a href="#">Tarefas <span class="pull-right badge bg-aqua">5</span></a></li>
                                        <li><a href="#">Projetos Completos <span class="pull-right badge bg-green">12</span></a></li>
                                        <li><a href="#">Seguidores <span class="pull-right badge bg-red">842</span></a></li>
                                    </ul>
                                </div>

                                @endif

                            </div>
                            <!-- /.widget-user -->
                        </div>

                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>

@endsection
