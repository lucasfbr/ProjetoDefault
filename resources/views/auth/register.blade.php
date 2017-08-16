@extends('auth.templates.template')

@section('content')

    <div class="register-box-body">
        <p class="login-box-msg">Registrar um novo usuário</p>

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}"
              name="formularioRegister" id="formularioRegister">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required
                       autofocus placeholder="Nome Completo">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">


                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required
                       placeholder="email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif

            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">

                <input id="password" type="password" class="form-control" name="password" required placeholder="Senha">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group has-feedback">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                       placeholder="Confirma senha">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>


            <div class="row">
                <div class="form-group col-xs-12">
                    <input type="radio" name="tipo" id="tipo" value="2" checked>
                    Contrate uma de nossas consultorias
                </div>
            </div>

            <div class="row">
                <div class="form-group col-xs-12">
                    <input type="radio" name="tipo" id="tipo" value="1">
                    Seja um dos nossos consultores
                </div>
            </div>

            <div class="row">
                <div class="form-group col-xs-12">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="termos" id="termos" v-model="checkTermos" > Estou de acordo com os<a href="#" data-toggle="modal" data-target="#myModal"> termos</a>
                        </label>
                    </div>
                </div>
            </div>

            <div class="row submitRegister">
                <div class="col-xs-12">
                    <button name="btnRegistrar"
                            id="btnRegistrar"
                            type="submit"
                            class="btn btn-primary btn-block btn-flat"
                            v-bind:disabled="!checkTermos">Registro
                    </button>
                </div>
            </div>
        </form>

        <a href="/login" class="text-center">Já sou registrado</a>
    </div>
    <!-- /.form-box -->


    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Termos de utilização do sistema </h4>
                </div>
                <div class="modal-body">

                    {!! info_sistem()->termosDeContrato != '' ? info_sistem()->termosDeContrato : 'Nenhum contrato definido até o momento' !!}

                </div>
                <div class="modal-footer">
                    <div class="col-ms-2">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Voltar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
