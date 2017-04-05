@extends('painel.templates.template')

@section('content')


    <section class="content-header">
        <h1>
            Mensagens
            <small>13 Mensagens novas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mensagens</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="compose.html" class="btn btn-primary btn-block margin-bottom">Nova mensagem</a>

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
                            <li class="active"><a href="/painel/mensagem"><i class="fa fa-inbox"></i> Caixa de entrada
                                    <span class="label label-primary pull-right">12</span></a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i> Enviados</a></li>
                            <li><a href="#"><i class="fa fa-file-text-o"></i> Rascunhos</a></li>
                            <li><a href="#"><i class="fa fa-filter"></i> Lixeira <span class="label label-warning pull-right">65</span></a>
                            </li>
                            <li><a href="#"><i class="fa fa-trash-o"></i> Enviar para lixeira</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Mensagem enviada para {{ info_sistem()->titulo != '' ? info_sistem()->titulo : 'Titulo do sistema' }}</h3>

                        <div class="box-tools pull-right">
                            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                        </div>
                    </div>
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
                            <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
                            <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
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
    </section>

@endsection
