@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            Usuarios
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/painel/user">Usuários</li>
            <li class="active">Cadastro</li>
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
                    <h3 class="box-title">Cadatre um novo usuário</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="/painel/user/create" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name">Nome</label>
                            <input class="form-control" id="name" name="name" type="text" value="{{ old('email') }}"
                                   autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>E-mail</label>
                            <input class="form-control" id="email" name="email" type="text" value="{{ old('email') }}"
                                   autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('tipo') ? ' has-error' : '' }}">
                            <label>Tipo de usuário</label>
                            <br/>
                            <label class="radio-inline">
                                <input type="radio" name="tipo" id="tipo1" value="0"> Administtrador
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="tipo" id="tipo2" value="1"> Consultor
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="tipo" id="tipo3" value="2" checked> Cliente
                            </label>

                            @if ($errors->has('tipo'))
                                <span class="help-block">
                                            <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label>Senha</label>
                            <input id="password" type="password" class="form-control" name="password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Confirma senha</label>
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation">
                        </div>

                        <div class="form-group">
                            <label for="img">Foto</label>
                            <input type="file" id="foto" name="foto">

                            <p class="help-block">Selecione uma foto ou imagem para o usuário</p>
                        </div>

                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <input class="form-control" id="estado" name="estado" type="text"
                                   value="{{ old('estado') }}"
                                   autofocus>
                        </div>

                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input class="form-control" id="cidade" name="cidade" type="text"
                                   value="{{ old('cidade') }}"
                                   autofocus>
                        </div>


                        <div class="form-group">
                            <label for="profissao">Profissão</label>
                            <input class="form-control" id="profissao" name="profissao" type="text"
                                   value="{{ old('profissao') }}"
                                   autofocus>
                        </div>

                        <div class="form-group">
                            <label for="empresa">Empresa</label>
                            <input class="form-control" id="empresa" name="empresa" type="text"
                                   value="{{ old('empresa') }}"
                                   autofocus>
                        </div>

                        <div class="form-group">
                            <label for="formacao">Formação</label>
                            <textarea id="formacao" name="formacao" class="form-control" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="habilidades">Habilidades</label>
                            <textarea id="habilidades" name="habilidades" class="form-control" rows="5"></textarea>
                            <p class="help-block">Separe cada habilidade por virgula. Ex: Word, Excell, Power Point</p>
                        </div>

                        <div class="form-group">
                            <label>Telefone</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" id="fone" name="fone" class="form-control" data-inputmask='"mask": "(99) 9999-9999"' data-mask>
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label>Celular</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" id="celular" name="celular" class="form-control" data-inputmask='"mask": "(99) 99999-9999"' data-mask>
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label for="sexo">Sexo</label>
                            <br/>
                            <label class="radio-inline">
                                <input type="radio" name="sexo" id="sexo" value="m" checked> Masculino
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="sexo" id="sexo" value="f"> Feminino
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="notas">Notas</label>
                            <textarea id="notas" name="notas" class="form-control" rows="5"></textarea>
                            <p class="help-block">Informações adicionais sobre o usuário</p>
                        </div>

                    </div>

                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">

                    <div class="box-footer">
                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                    </div>
                </form>
            </div>

        </div>


    </section>

@endsection
