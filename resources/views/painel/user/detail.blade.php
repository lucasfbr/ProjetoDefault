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
                                        <a href="" data-toggle="modal" data-target="#myModal"><strong><i class="fa fa-book margin-r-5"></i>Formação</strong></a>

                                        <hr>

                                        <strong><i class="fa fa-map-marker margin-r-5"></i>Localização</strong>

                                        <p class="text-muted">{{ $perfil ? $perfil->logradouro : ''}}, {{ $perfil ? $perfil->numero : ''}}, {{ $perfil ? $perfil->bairro : ''}}, {{ $perfil ? $perfil->cidade : '' }}, {{ $perfil ? $perfil->estado : '' }}</p>

                                        <hr>

                                        <strong><i class="fa fa-pencil margin-r-5"></i>Habilidades</strong>

                                        <br />

                                        @foreach(stringToArray($perfil->habilidades) as $key => $habilidade)
                                            <span class="label label-primary">{{$habilidade}}</span>
                                            @if((($key + 1) % 4) == 0)
                                                <br>
                                            @endif
                                        @endforeach

                                        <hr>

                                        <strong><i class="fa fa-at margin-r-5"></i> E-mail</strong>

                                        <p>{{ $user->email }}</p>

                                        <hr>

                                        <strong><i class="fa fa-briefcase margin-r-5"></i> Experiência Profissional</strong>

                                        <p>{{$experienciaProfissional ? formatarExpProfissional($experienciaProfissional) : 'Nenhuma experiência'}}</p>

                                        <hr>

                                        <strong><i class="fa fa-briefcase margin-r-5"></i> Experiência com metodologia LEAN</strong>

                                        <p>{{$perfil->experienciaLean ? $perfil->experienciaLean . ' Ano(s)': 'Nenhuma experiência'}}</p>

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

                                        <strong><i class="fa fa-briefcase margin-r-5"></i> Experiência como consultor</strong>

                                        <p>{{$perfil->experienciaConsultor ? $perfil->experienciaConsultor . ' Ano(s)' : 'Nenhuma experiência'}}</p>

                                        <hr>

                                        <strong><i class="fa fa-money margin-r-5"></i> Valor a ser cobrado por hora</strong>

                                        <p>{{valorHora($experienciaProfissional,$perfil->experienciaConsultor,$perfil->experienciaLean)}}</p>

                                    </div>
                                    <!-- /.box-body -->

                                    <div  class="box-body col-md-12">
                                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Notas</strong>

                                        <p>{{-- $user->notas --}}</p>
                                    </div>

                                @if($user->tipo == 'Consultor')

                                <div class="box-footer no-padding col-md-6">
                                    <ul class="nav nav-stacked">
                                        <li><a href="#">Projetos em andamento <span class="pull-right badge bg-blue">0</span></a></li>
                                        <li><a href="#">Projetos Completos <span class="pull-right badge bg-green">0</span></a></li>
                                        <li><a href="#">Avaliações <span class="pull-right badge bg-red">0</span></a></li>
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


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Formação de <strong>{{$user->name}}</strong></h4>
                    </div>
                    <div class="modal-body">
                        <ul class="timeline timeline-inverse">

                        @if($formacao)
                            @foreach($formacao as $form)
                                <!-- timeline time label -->
                                    <li class="time-label">
                                                <span class="bg-blue">
                                                    {{$form->dataFormacao}}
                                                </span>
                                    </li>
                                    <!-- /.timeline-label -->

                                    <!-- timeline item -->
                                    <li>
                                        <!-- timeline icon -->
                                        <i class="fa fa-graduation-cap bg-blue"></i>
                                        <div class="timeline-item">

                                            <h3 class="timeline-header">{{$form->titulo}}</h3>

                                            <div class="timeline-body">
                                                {{$form->conteudo}}
                                            </div>

                                            <div class="timeline-footer">
                                                <a href="{{$form->link}}" target="_blank"
                                                   class="btn btn-success btn-xs">Página da instituição</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach


                                <li>
                                    <i class="fa fa-circle bg-blue"></i>
                                </li>
                            @else
                                <li>
                                    <p class="text-info">Nenhuma formação  registrada</p>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>


@endsection
