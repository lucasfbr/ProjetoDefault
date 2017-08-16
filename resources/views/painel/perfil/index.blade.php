@extends('painel.templates.template')

@section('content')


    <section class="content-header">
        <h1>
            Perfil
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Perfil</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-4">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle"
                             src="/{{$user->foto ? $user->foto : 'img/default3.png'}}" alt="User profile picture">

                        <h3 class="profile-username text-center">{{$user->name}}</h3>

                        <p class="text-muted text-center">{{$perfil ? $perfil->profissao : ''}}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>{{$user->tipo}} desde</b> <a class="pull-right">{{$user->created_at}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Status</b> <a
                                        class="pull-right {{$user->status === 'Inativo' ? 'text-danger' : ''}}">{{$user->status}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Perfil</b> <a
                                        class="pull-right {{$user->perfil === 'Incompleto' ? 'text-danger' : ''}}">{{$user->perfil}}</a>
                            </li>
                        </ul>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sobre mim</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Localidade</strong>

                        <p class="text-muted">
                            {{$perfil ? $perfil->logradouro . ', ' : ''}}
                            {{$perfil ? $perfil->numero . ' - ' : ''}}
                            {{$perfil ? $perfil->bairro . ' - ' : ''}}
                            {{$perfil ? $perfil->cidade . ' - ' : ''}}
                            {{$perfil ? $perfil->estado : ''}}
                        </p>

                        <hr>

                        @if($user->tipo == 'Administrador' || $user->tipo == 'Consultor' )

                            <strong><i class="fa fa-pencil margin-r-5"></i> Consultor nas áreas de:</strong>

                            <p>
                                @if($userService)
                                    @foreach($userService as $key => $us)
                                        <span class="label label-primary">{{$us->titulo}}</span>
                                        @if((($key + 1) % 4) == 0)
                                            <br><br>
                                        @endif
                                    @endforeach
                                @endif
                            </p>

                            <hr>

                            <strong><i class="fa fa-pencil margin-r-5"></i> Habilidades</strong>

                            <p>
                                @if($perfil)
                                    @foreach(stringToArray($perfil->habilidades) as $key => $habilidade)
                                        <span class="label label-primary">{{$habilidade}}</span>
                                        @if((($key + 1) % 4) == 0)
                                        <br><br>
                                        @endif
                                    @endforeach
                                @endif
                            </p>

                            <hr>

                            <strong><i class="fa fa-file-text-o margin-r-5"></i> Notas</strong>

                            <p>{{$perfil ? $perfil->notas : ''}}</p>
                        @endif




                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="false">Alterações</a></li>

                        @can('view_formacao')
                        <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="true">Formação</a></li>
                        @endcan

                        @can('view_atuacao')
                        <li class=""><a href="#atuacao" data-toggle="tab" aria-expanded="true">Áreas de atuação</a></li>
                        @endcan

                        <li class=""><a href="#curriculo" data-toggle="tab" aria-expanded="true">Curriculo</a></li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="settings">

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

                                <br>

                                <form class="form-horizontal" role="form" method="post" action="/painel/perfil/update/{{$user->id}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border text-light-blue">
                                        Conta do usuário
                                    </legend>

                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-sm-2 control-label">Nome</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="name" name="name" type="text" value="{{$user->name}}">
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="email" name="email" type="text" value="{{$user->email}}">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-sm-2 control-label">Senha</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="password" name="password" type="password">
                                            <p class="text-info">Para manter a senha original, deixe o campo senha em branco</p>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-2 control-label">Confirma Senha</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto" class="col-sm-2 control-label">Foto</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="foto" name="foto">

                                            <p class="help-block">Selecione uma foto ou imagem para o usuário</p>
                                        </div>
                                    </div>

                                    @if($user->usuarioPrincipal == 1)
                                        <div class="form-group">
                                            <label for="foto_perfil" class="col-sm-2 control-label">Foto destaque</label>
                                            <div class="col-sm-10">
                                                <input type="file" id="foto_perfil" name="foto_perfil">

                                                <p class="help-block">Foto de corpo inteiro do seo da empresa</p>
                                            </div>
                                        </div>
                                    @endif

                                </fieldset>

                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border text-light-blue">
                                        Dados Pessoais
                                    </legend>

                                    <div class="form-group {{ $errors->has('cep') ? ' has-error' : '' }}">
                                        <label for="cep" class="col-sm-2 control-label">Cep</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" id="cep" name="cep"
                                                   type="text"
                                                   value="{{$perfil ? $perfil->cep : ''}}"
                                                   v-model="cep"
                                                   v-on:keyup="buscar"
                                                   data-inputmask='"mask": "99999-999"' data-mask>

                                            @if ($errors->has('cep'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('cep') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('estado') ? ' has-error' : '' }}">
                                        <label for="estado" class="col-sm-2 control-label">Estado</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" id="estado" name="estado"
                                                   type="text"
                                                   value="{{$perfil ? $perfil->estado : ''}}"
                                                   v-model="endereco.uf" v-el:estado>

                                            @if ($errors->has('estado'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('estado') }}</strong>
                                            </span>
                                            @endif

                                            <p class="text-danger" style="display: none" v-show="naoLocalizado"><strong>Estado
                                                    não localizado</strong>. Preencha manualmente</p>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('cidade') ? ' has-error' : '' }}">
                                        <label for="cidade" class="col-sm-2 control-label">Cidade</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" id="cidade" name="cidade"
                                                   type="text"
                                                   value="{{$perfil ? $perfil->cidade : ''}}"
                                                   v-model="endereco.localidade">

                                            @if ($errors->has('cidade'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('cidade') }}</strong>
                                            </span>
                                            @endif

                                            <p class="text-danger" style="display: none" v-show="naoLocalizado"><strong>Cidade
                                                    não localizada</strong>. Preencha manualmente</p>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('bairro') ? ' has-error' : '' }}">
                                        <label for="bairro" class="col-sm-2 control-label">Bairro</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" id="bairro" name="bairro"
                                                   type="text"
                                                   value="{{$perfil ? $perfil->bairro : ''}}"
                                                   v-model="endereco.bairro">

                                            @if ($errors->has('bairro'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('bairro') }}</strong>
                                            </span>
                                            @endif

                                            <p class="text-danger" style="display: none" v-show="naoLocalizado"><strong>Bairro
                                                    não localizado</strong>. Preencha manualmente</p>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('logradouro') ? ' has-error' : '' }}">
                                        <label for="logradouro" class="col-sm-2 control-label">Logradouro</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" id="logradouro" name="logradouro"
                                                   type="text"
                                                   value="{{$perfil ? $perfil->logradouro : ''}}"
                                                   v-model="endereco.logradouro">

                                            @if ($errors->has('logradouro'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('logradouro') }}</strong>
                                            </span>
                                            @endif

                                            <p class="text-danger" style="display: none" v-show="naoLocalizado"><strong>Logradouro
                                                    não localizado</strong>. Preencha manualmente</p>
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('numero') ? ' has-error' : '' }}">
                                        <label for="numero" class="col-sm-2 control-label">Numero</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" id="numero" name="numero"
                                                   type="text"
                                                   value="{{$perfil ? $perfil->numero : ''}}"
                                                   v-el:numero>

                                            @if ($errors->has('numero'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('numero') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="complemento" class="col-sm-2 control-label">Complemento</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" id="complemento" name="complemento"
                                                   placeholder="Complemento"
                                                   type="text"
                                                   value="{{$perfil ? $perfil->complemento : ''}}">
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('sexo') ? ' has-error' : '' }}">
                                        <label for="complemento" class="col-sm-2 control-label">Sexo</label>

                                        <div class="col-sm-10">
                                            <label class="radio-inline">
                                                <input type="radio" name="sexo" id="sexo"
                                                       value="m" {{  $perfil && $perfil->sexo == 'm' ? 'checked' : '' }}>
                                                Masculino
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="sexo" id="sexo"
                                                       value="f" {{  $perfil && $perfil->sexo == 'f' ? 'checked' : '' }}>
                                                Feminino
                                            </label>

                                            @if ($errors->has('sexo'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('sexo') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="fone" class="col-sm-2 control-label">Telefone</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" id="fone" name="fone"
                                                   type="text"
                                                   data-inputmask='"mask": "(99) 9999-9999"' data-mask
                                                   value="{{$perfil ? $perfil->fone : ''}}">
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('celular') ? ' has-error' : '' }}">
                                        <label for="celular" class="col-sm-2 control-label">Celular</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" id="celular" name="celular"
                                                   type="text"
                                                   data-inputmask='"mask": "(99) 99999-9999"' data-mask
                                                   value="{{$perfil ? $perfil->celular : ''}}">

                                            @if ($errors->has('celular'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('celular') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                </fieldset>

                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border text-light-blue">
                                        Dados Profissionais
                                    </legend>

                                    <div class="form-group {{ $errors->has('empresa') ? ' has-error' : '' }}">
                                        <label for="empresa" class="col-sm-2 control-label">Empresa Atual</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" id="empresa" name="empresa"
                                                   type="text"
                                                   value="{{$perfil ? $perfil->empresa : ''}}">

                                            @if ($errors->has('empresa'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('empresa') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('profissao') ? ' has-error' : '' }}">
                                        <label for="profissão" class="col-sm-2 control-label">Profissão</label>

                                        <div class="col-sm-10">
                                            <input class="form-control" id="profissao" name="profissao"
                                                   type="text"
                                                   value="{{$perfil ? $perfil->profissao : ''}}">

                                            @if ($errors->has('profissao'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('profissao') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    @if($user->tipo == 'Consultor' || $user->tipo == 'Administrador')
                                        <div class="form-group {{ $errors->has('resumo') ? ' has-error' : '' }}">
                                            <label for="resumo" class="col-sm-2 control-label">Breve descrição do
                                                profissional</label>

                                            <div class="col-sm-10">
                                                <textarea id="resumo" name="resumo" class="form-control" rows="3">{{$perfil ? $perfil->resumo : ''}}</textarea>
                                                @if ($errors->has('resumo'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('resumo') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <!--<div class="form-group {{-- $errors->has('descricao') ? ' has-error' : '' --}}">
                                            <label for="descricao" class="col-sm-2 control-label">Experiência Profissional</label>

                                            <div class="col-sm-10">
                                                <textarea name="descricao" id="descricao" class="form-control" rows="3">{{$perfil ? $perfil->descricao : ''}}</textarea>
                                                {{--@if ($errors->has('descricao'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('descricao') }}</strong>
                                                </span>
                                                @endif--}}
                                            </div>
                                        </div>-->

                                        <div class="form-group {{ $errors->has('habilidades') ? ' has-error' : '' }}">
                                            <label for="habilidades" class="col-sm-2 control-label">Habilidades</label>

                                            <div class="col-sm-10">
                                                <textarea id="habilidades" name="habilidades" class="form-control" rows="3">{{$perfil ? $perfil->habilidades : ''}}</textarea>
                                                <p class="help-block">Separe suas habilidades por virgula. Ex: Word,Excell,Liderança</p>

                                                @if ($errors->has('habilidades'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('habilidades') }}</strong>
                                                </span>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->has('experienciaLean') ? ' has-error' : '' }}">
                                            <label for="experienciaLean" class="col-sm-2 control-label">Experiência em lean</label>

                                            <div class="col-sm-10">
                                                <input class="form-control" id="experienciaLean" name="experienciaLean" data-inputmask='"mask": "99"' data-mask
                                                       type="text"
                                                       value="{{$perfil ? $perfil->experienciaLean : ''}}">
                                                <p class="help-block">Experiência em anos</p>

                                                @if ($errors->has('experienciaLean'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('experienciaLean') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group {{ $errors->has('experienciaConsultor') ? ' has-error' : '' }}">
                                            <label for="experienciaConsultor" class="col-sm-2 control-label">Experiência como consultor</label>

                                            <div class="col-sm-10">
                                                <input class="form-control" id="experienciaConsultor" name="experienciaConsultor" data-inputmask='"mask": "99"' data-mask
                                                       type="text"
                                                       value="{{$perfil ? $perfil->experienciaConsultor : ''}}">
                                                <p class="help-block">Experiência em anos</p>

                                                @if ($errors->has('experienciaConsultor'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('experienciaConsultor') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="notas" class="col-sm-2 control-label">Notas</label>

                                            <div class="col-sm-10">
                                                <textarea id="notas" name="notas" class="form-control" rows="3">{{$perfil ? $perfil->notas : ''}}</textarea>
                                                <p class="help-block">Alguma observação que seja relevente para seu curriculo</p>
                                            </div>
                                        </div>


                                </fieldset>

                                <fieldset class="scheduler-border">
                                   <legend class="scheduler-border text-light-blue">
                                            Experiência Profissional
                                   </legend>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">

                                                <div class="list-group" v-for="exp in experienciaLista">
                                                    <div class="list-group-item active">
                                                        @{{exp.empresa}} <div class="pull-right"><a href="#" v-on:click="removeExperiencia($event,$index)"><span class="linkRemove">X</span></a></div>
                                                    </div>
                                                    <div class="list-group-item"><strong>Cardo:</strong>@{{exp.cargo}}</div>
                                                    <div class="list-group-item"><strong>Data de entrada:</strong>@{{exp.dataEntrada}}</div>
                                                    <div class="list-group-item"><strong>Data de saida:</strong>@{{exp.dataSaida}}</div>
                                                </div>


                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="empresa" class="col-sm-2 control-label">Empresa</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" v-model="experiencia.empresa">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="cargo" class="col-sm-2 control-label">Cargo</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" v-model="experiencia.cargo">
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label for="data_entrada" class="col-sm-2 control-label">Data de entrada</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" v-model="experiencia.dataEntrada" data-inputmask='"mask": "99/99/9999"' data-mask>
                                            </div>
                                         </div>

                                          <div class="form-group">
                                            <label for="data_saida" class="col-sm-2 control-label">Data de saída</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" v-model="experiencia.dataSaida" data-inputmask='"mask": "99/99/9999"' data-mask>
                                            </div>
                                          </div>


                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button class="btn btn-success" v-on:click="addExperiencia($event)">Add</button>
                                            </div>
                                        </div>

                                </fieldset>

                                @endif


                                <br>
                                <br>

                                <input type="hidden" name="experienciaProfissional" id="experienciaProfissional" value="@{{experienciaLista}}">

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Atualizar</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- /.tab-pane -->


                        <div class="tab-pane" id="timeline">

                            <a href="/painel/formacao/{{$user->id}}" class="btn btn-warning"
                               alt="Adicione uma nova formação" title="Adicione uma nova formação">
                                Nova Formação
                            </a>

                            <br><br>

                            <!-- The timeline -->
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

                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="atuacao">

                                <form class="form-horizontal" role="form" method="post" action="/painel/user/addUserService/{{$user->id}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <fieldset class="scheduler-border">
                                        <legend class="scheduler-border text-light-blue">
                                            Selecione quais áreas você prestará consultoria
                                        </legend>
                                    </fieldset>


                                    @foreach($services as $ser)

                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="services[]" value="{{$ser->id}}" @foreach($userService as $us) @if($us->id == $ser->id) checked @endif @endforeach>
                                                {{$ser->titulo}}
                                            </label>
                                        </div>

                                    @endforeach

                                    <br><br>
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-danger">Cadastrar</button>
                                        </div>
                                    </div>

                                </form>

                        </div>

                        <div class="tab-pane" id="curriculo">

                            <form class="form-horizontal" role="form" method="post" action="/painel/user/addExperiencia/{{$user->id}}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border text-light-blue">
                                        Cadastre suas experiêcias profissionais
                                    </legend>
                                </fieldset>


                                <br><br>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-danger">Cadastrar</button>
                                    </div>
                                </div>

                            </form>

                        </div>



                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>

@endsection
