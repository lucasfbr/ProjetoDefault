@extends('auth.templates.template')

@section('content')

    <div class="register-box-body">
        <p class="login-box-msg">Registrar um novo usuário</p>

        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}"
              name="formularioRegister" id="formularioRegister">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Nome Completo">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('name'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">


                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required placeholder="email">
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
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirma senha">
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
                    <input type="radio" name="tipo" id="tipo" value="1" >
                    Seja um dos nossos consultores
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12 {{ $errors->has('termos') ? ' has-error' : '' }}">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="termos" id="termos"> Estou de acordo com os<a href="#" data-toggle="modal" data-target="#myModal"> termos</a>
                            @if ($errors->has('termos'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('termos') }}</strong>
                                    </span>
                            @endif
                        </label>
                    </div>
                </div>
            </div>

            <div class="row submitRegister">
                <div class="col-xs-12">
                    <button name="btnRegistrar" id="btnRegistrar" type="submit" class="btn btn-primary btn-block btn-flat">Registro</button>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Termos de utilização do sistema </h4>
                </div>
                <div class="modal-body">


                   <p>
                       Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque molestie felis ut nisl vehicula luctus. Pellentesque varius imperdiet efficitur. Aliquam eu dignissim lorem. Morbi vitae facilisis nibh. Vestibulum et purus auctor nunc blandit mattis. Quisque sollicitudin interdum quam, vel ornare augue laoreet at. Quisque convallis lacinia ex ac fermentum. Donec non laoreet orci. Nam a ex nec lorem lacinia ullamcorper sed sed urna. Donec pharetra, mi scelerisque feugiat elementum, neque lorem imperdiet libero, in lobortis nibh libero in enim. Vestibulum purus neque, posuere quis mauris vitae, tristique ullamcorper mauris.

                    Ut pharetra, diam sed rhoncus dictum, ipsum sapien faucibus odio, in mollis diam diam et sem. Etiam viverra eros vel semper facilisis. Mauris dapibus faucibus elit eu dictum. Nulla quis laoreet turpis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus porta, nulla in vestibulum sodales, neque nulla rutrum nibh, vel elementum nisl magna vel tellus. Nulla sapien erat, cursus non cursus sit amet, convallis ut felis. Maecenas tellus libero, ornare in tellus ut, euismod ornare leo. Vivamus eget venenatis erat. Suspendisse sodales leo tempor tellus feugiat elementum. Etiam vitae felis ac urna dictum laoreet quis vel nisi. Fusce vulputate urna quis tristique faucibus. Proin tincidunt, nisl nec hendrerit lacinia, lectus ligula faucibus ipsum, feugiat mattis turpis lorem eu sem. Nunc justo nulla, vehicula at nulla at, aliquam suscipit dui.
                    </p>
                    <p>
                    Aliquam dapibus ante eu magna condimentum, sollicitudin ultricies nibh tincidunt. Aenean volutpat libero et dui lacinia, sed fermentum neque rhoncus. Nulla maximus augue et justo scelerisque aliquet. Pellentesque quis nulla nec tellus blandit congue. Nunc iaculis vel erat non dapibus. Aenean orci eros, maximus ac rutrum nec, aliquam sed neque. In congue fringilla metus, quis scelerisque tortor condimentum ac. Vestibulum vitae pharetra arcu. Pellentesque ac rhoncus nunc.

                    Sed sagittis, orci eget congue dictum, ante metus ornare dolor, vel dictum mi velit vel lacus. Aliquam ornare imperdiet placerat. Donec sit amet finibus elit. Nunc hendrerit magna erat. Fusce consequat eleifend risus. Vivamus et dui in quam volutpat rutrum sit amet non ante. Suspendisse sollicitudin urna non euismod finibus. Fusce eget volutpat augue. Nunc ultricies nulla et suscipit ultricies. Mauris a magna sit amet nisl aliquam tempus.
                    </p>
                    <p>
                    Phasellus pretium nec erat ut molestie. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas imperdiet tellus arcu, vel ultricies eros placerat id. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce at eros ultrices dui luctus ultricies nec id lorem. Etiam blandit sem nec erat ornare commodo. Duis congue fermentum ligula ultricies vulputate. In id finibus tellus. Sed ut semper elit. Vestibulum metus ante, iaculis vitae leo a, hendrerit varius nibh. In feugiat ornare justo varius faucibus. Maecenas consectetur ligula nec arcu fringilla elementum. Nunc porttitor mi volutpat mi ullamcorper fermentum. Nulla egestas malesuada velit, sagittis convallis nunc accumsan id.

                    Nam fermentum velit ligula, in dignissim leo semper at. Donec tortor nibh, eleifend eu semper nec, finibus vel magna. Suspendisse ac arcu aliquet, cursus mi sed, mollis nunc. Praesent vitae tempor magna. Curabitur aliquet purus vel justo scelerisque blandit. Curabitur fringilla, tellus mollis facilisis hendrerit, risus ipsum bibendum mauris, a molestie tellus purus non velit. Curabitur varius consectetur elementum. Vestibulum iaculis orci non nisi elementum, nec rutrum dui blandit. Praesent a sodales ipsum, a tristique massa. Donec posuere egestas libero tincidunt luctus. Nulla hendrerit nibh lorem, id pellentesque mauris dapibus at. Vestibulum velit sapien, luctus ac rhoncus non, venenatis quis lectus. Nulla non tortor commodo, rutrum felis at, dignissim felis. Sed consectetur quam id est tempor ultrices. Proin ac sagittis mi, vel placerat elit.
                    </p>
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
