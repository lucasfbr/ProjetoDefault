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
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle"
                             src="/{{$user->foto ? $user->foto : 'img/default3.png'}}" alt="User profile picture">

                        <h3 class="profile-username text-center">{{$user->name}}</h3>

                        <p class="text-muted text-center">{{$perfil->profissao}}</p>

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
                            {{$perfil->logradouro ? $perfil->logradouro . ', ' : ''}}
                            {{$perfil->numero ? $perfil->numero . ' - ' : ''}}
                            {{$perfil->bairro ? $perfil->bairro . ' - ' : ''}}
                            {{$perfil->cidade ? $perfil->cidade . ' - ' : ''}}
                            {{$perfil->estado ? $perfil->estado : ''}}
                        </p>
                        <hr>

                        <strong><i class="fa fa-pencil margin-r-5"></i> Habilidades</strong>

                        <p>
                            @foreach(stringToArray($perfil->habilidades) as $habilidade)
                                <span class="label label-primary">{{$habilidade}}</span>
                            @endforeach
                        </p>

                        <hr>

                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Notas</strong>

                        <p>{{$perfil->notas}}</p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#timeline" data-toggle="tab" aria-expanded="true">Formação</a></li>
                        <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Alterações</a></li>
                    </ul>
                    <div class="tab-content">

                        <!-- /.tab-pane -->
                        <div class="tab-pane active" id="timeline">
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">
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
                                                <a href="{{$form->link}}" target="_blank" class="btn btn-success btn-xs">Página da instituição</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                                <li>
                                    <i class="fa fa-circle bg-blue"></i>
                                </li>
                            </ul>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10">
                                        <input class="form-control" id="inputName" placeholder="Name" type="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        <input class="form-control" id="inputEmail" placeholder="Email" type="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10">
                                        <input class="form-control" id="inputName" placeholder="Name" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="inputExperience"
                                                  placeholder="Experience"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                                    <div class="col-sm-10">
                                        <input class="form-control" id="inputSkills" placeholder="Skills" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> I agree to the <a href="#">terms and
                                                    conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
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
