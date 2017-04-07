@extends('painel.templates.template')

@section('content')


    <section class="content-header">
        <h1>
            Mensagens
            <small>{{$totalMensagens}} Mensagens novas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mensagens</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pastas</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active">
                                <a href="/painel/mensagem/">
                                    <i class="fa fa-inbox"></i> Caixa de entrada
                                    <span class="label label-primary pull-right">{{$totalMensagens}}</span></a>
                            </li>
                            <li><a href="/painel/mensagem/trash"><i class="fa fa-trash-o"></i>  Lixeira <span class="label label-warning pull-right">{{$totalLixeira}}</span></a>
                            </li>

                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">


                @if (session('erro'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session('erro') }}
                    </div>
                @endif

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Mensagem enviada para {{ info_sistem()->titulo != '' ? info_sistem()->titulo : 'Titulo do sistema' }}</h3>

                    </div>

                    @if($mensagem->resposta)
                        <div class="box-body no-padding">

                            <div class="mailbox-read-info">
                                <h3>Assunto: Resposta pelo site</h3>
                                <h5>De: {{usuarioPrincipal()->name}}
                                    <span class="mailbox-read-time pull-right">{{$mensagem->updated_at}}</span>
                                </h5>
                            </div>

                            <!-- /.mailbox-controls -->
                            <div class="mailbox-read-message">
                                <p>{!! $mensagem->resposta !!}</p>
                            </div>
                            <!-- /.mailbox-read-message -->
                        </div>
                        <!-- /.box-body -->

                        <div class="msgSeparador"></div>
                    @endif

                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="mailbox-read-info">
                            <h3>Assunto: Contato pelo site</h3>
                            <h5>De: {{$mensagem->email}}
                                <span class="mailbox-read-time pull-right">{{$mensagem->created_at}}</span></h5>
                            <h5>Nome: {{$mensagem->nome}}</h5>
                            <h5>Telefone: {{$mensagem->telefone}}</h5>
                        </div>
                        <!-- /.mailbox-read-info -->

                        <!-- /.mailbox-controls -->
                        <div class="mailbox-read-message">
                            <p>{{$mensagem->mensagem}}</p>
                        </div>
                        <!-- /.mailbox-read-message -->
                    </div>
                    <!-- /.box-body -->
                                        <!-- /.box-footer -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal"><i class="fa fa-share"></i>Responder</button>
                        </div>
                        <button type="button" class="btn btn-default" v-on:click="readMsgLixeira({{$mensagem->id}})" ><i class="fa fa-trash-o"></i> Delete</button>
                        <a href="/painel/mensagem/read/print/{{$mensagem->id}}" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Envie uma resposta para esta mensagem</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/painel/mensagem/read/resposta/{{$mensagem->id}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea class="form-control textarea" id="resposta" name="resposta" rows="10"
                                          placeholder="Conteúdo da mensagem ...">
                                </textarea>
                                <input type="hidden" name="nome" id="nome" value="{{$mensagem->nome}}">
                                <input type="hidden" name="email" id="email" value="{{$mensagem->email}}">
                                <input type="hidden" name="telefone" id="telefone" value="{{$mensagem->telefone}}">
                                <input type="hidden" name="mensagem" id="mensagem" value="{{$mensagem->mensagem}}">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                <input type="submit" class="btn btn-primary" value="Enviar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>

@endsection
