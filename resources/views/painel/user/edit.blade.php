@extends('painel.templates.template')

@section('content')


    <section class="content-header">
        <h1>
            Usuários
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class=""><a href="/painel/user">usuários</a></li>
            <li class="active">Editar</li>
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
                @elseif(session('erro'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        {{ session('erro') }}
                    </div>
                @endif

                <div class="box-header with-border">
                    <h3 class="box-title">Edite os dados do usuário</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="/painel/user/update/{{ $user->id }}"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-3 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Nome</label>
                                <input class="form-control" id="name" name="name" type="text" value="{{ $user->name }}"
                                       autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-3 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label>E-mail</label>
                                <input class="form-control" id="email" name="email" type="text"
                                       value="{{ $user->email }}"
                                       autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>


                            <div class="col-md-3 form-group">
                                <label for="cep">Cep</label>
                                <input class="form-control" id="cep" name="cep" type="text"
                                       autofocus
                                       v-model="cep"
                                       v-on:keyup="buscar"
                                       data-inputmask='"mask": "99999-999"' data-mask
                                       value="{{$user->cep}}">
                            </div>


                            <div class="col-md-3 form-group">
                                <label for="estado">Estado</label>
                                <input class="form-control" id="estado" name="estado" type="text"  v-model="endereco.uf" v-el:estado
                                       value="{{$user->estado}}"
                                       autofocus>

                                <p class="text-danger" style="display: none" v-show="naoLocalizado"><strong>Estado não localizado</strong>. Preencha manualmente</p>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3 form-group">
                                <label for="cidade">Cidade</label>
                                <input class="form-control" id="cidade" name="cidade" type="text"  v-model="endereco.localidade"
                                       value="{{$user->cidade}}"
                                       autofocus>
                                <p class="text-danger" style="display: none" v-show="naoLocalizado"><strong>Cidade não localizada</strong>. Preencha manualmente</p>
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="bairro">Bairro</label>
                                <input class="form-control" id="bairro" name="bairro" type="text"  v-model="endereco.bairro"
                                       value="{{$user->bairro}}"
                                       autofocus>
                                <p class="text-danger" style="display: none" v-show="naoLocalizado"><strong>Bairro não localizado</strong>. Preencha manualmente</p>
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="logradouro">Logradouro</label>
                                <input class="form-control" id="logradouro" name="logradouro" type="text"  v-model="endereco.logradouro"
                                       value="{{$user->logradouro}}"
                                       autofocus>
                                <p class="text-danger" style="display: none" v-show="naoLocalizado"><strong>Logradouro não localizado</strong>. Preencha manualmente</p>
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="cidade">Numero</label>
                                <input class="form-control" id="numero" name="numero" type="text" v-el:numero
                                       value="{{$user->numero}}"
                                       autofocus>
                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-3 form-group">
                                <label for="complemento">Complemento</label>
                                <input class="form-control" id="complemento" name="complemento" type="text"
                                       value="{{$user->complemento}}"
                                       autofocus>
                            </div>

                            <div class="col-md-3  form-group">
                                <label>Telefone</label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text" id="fone" name="fone" class="form-control"
                                           data-inputmask='"mask": "(99) 9999-9999"' data-mask value="{{$user->fone}}">
                                </div>
                                <!-- /.input group -->
                            </div>

                            <div class="col-md-3  form-group">
                                <label>Celular</label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <input type="text" id="celular" name="celular" class="form-control"
                                           data-inputmask='"mask": "(99) 99999-9999"' data-mask value="{{$user->celular}}">
                                </div>
                                <!-- /.input group -->
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="empresa">Empresa</label>
                                <input class="form-control" id="empresa" name="empresa" type="text"
                                       value="{{$user->empresa}}"
                                       autofocus>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3 form-group">
                                <label for="profissao">Profissão</label>
                                <input class="form-control" id="profissao" name="profissao" type="text"
                                       value="{{$user->profissao}}"
                                       autofocus>
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="sexo">Sexo</label>
                                <br/>
                                <label class="radio-inline">
                                    <input type="radio" name="sexo" id="sexo"
                                           value="m" {{ $user->sexo == 'Masculino' ? 'checked' : '' }}> Masculino
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="sexo" id="sexo"
                                           value="f" {{ $user->sexo == 'Feminino' ? 'checked' : '' }}> Feminino
                                </label>
                            </div>

                            <div class="col-md-3 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label>Senha</label>
                                <input id="password" type="password" class="form-control" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-3 form-group">
                                <label>Confirma senha</label>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation">
                            </div>

                        </div>

                        <!--<div class="row">

                            <div class="col-md-4 form-group">
                                <label for="formacao">Formação</label>
                                <textarea id="formacao" name="formacao" class="form-control" rows="5">{{--$user->formacao--}}</textarea>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="habilidades">Habilidades</label>
                                <textarea id="habilidades" name="habilidades" class="form-control" rows="5">{{--$user->habilidades--}}</textarea>
                                <p class="help-block">Separe cada habilidade por virgula. Ex: Word, Excell, Power
                                    Point</p>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="notas">Notas</label>
                                <textarea id="notas" name="notas" class="form-control" rows="5">{{--$user->notas--}}</textarea>
                                <p class="help-block">Informações adicionais sobre o usuário</p>
                            </div>

                        </div>-->

                        <div class="row">

                            <div class="col-md-5 form-group">
                                <label for="img">Foto</label>
                                <input type="file" id="foto" name="foto">

                                <p class="help-block">Selecione uma foto ou imagem para o usuário</p>
                            </div>


                            <div class="col-md-5 form-group{{ $errors->has('tipo') ? ' has-error' : '' }}">
                                <label>Tipo de usuário</label>
                                <br/>
                                <label class="radio-inline">
                                    <input type="radio" name="tipo" id="tipo1"
                                           value="0" {{ $user->tipo == 'Administrador' ? 'checked' : '' }}> Administtrador
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="tipo" id="tipo2"
                                           value="1" {{ $user->tipo == 'Consultor' ? 'checked' : '' }}> Consultor
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="tipo" id="tipo3"
                                           value="2" {{ $user->tipo == 'Cliente' ? 'checked' : '' }}> Cliente
                                </label>

                                @if ($errors->has('tipo'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-5 form-group">
                                <label>Usuário principal</label>
                                <br/>
                                <label class="radio-inline">
                                    <input type="radio" name="usuarioPrincipal" id="usuarioPrincipal"
                                           value="1" {{ $user->usuarioPrincipal == '1' ? 'checked' : '' }}> Sim
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="usuarioPrincipal" id="usuarioPrincipal"
                                           value="0" {{ $user->usuarioPrincipal == '0' ? 'checked' : '' }}> Não
                                </label>

                                <p class="help-block">O perfil e a formação do usuário principal serão exibidos na página "Quem Somos"</p>
                            </div>
                        </div>


                    </div>

                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="Editar">
                    </div>
                </form>

            </div>

        </div>


    </section>

@endsection
