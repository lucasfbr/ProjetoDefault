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


        @if (session('sucesso'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                {{ session('sucesso') }}
            </div>
            <br/>
        @elseif(session('erro'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                {{ session('erro') }}
            </div>
            <br/>
        @endif


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

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Caixa de entrada</h3>

                        <div class="box-tools pull-right">
                            <div class="has-feedback">
                                <form method="get" action="/painel/mensagem/search">
                                    <div class="input-group">
                                        <input name="val" id="val" type="text" class="form-control" placeholder="Buscar..." aria-describedby="basic-addon2">
                                        <span class="input-group-addon" id="basic-addon2">
                                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="mailbox-controls">
                            <!-- Check all button -->

                            <input type="checkbox" name="selectall" id="selectall">

                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm" v-on:click="enviarMsgLixeira"><i class="fa fa-trash-o"></i></button>
                                <button type="button" class="btn btn-default btn-sm" v-on:click="refresh"><i class="fa fa-refresh"></i></button>
                            </div>
                            <!-- /.btn-group -->

                            <div class="pull-right">
                                {{$mensagens->currentPage()}} de {{$mensagens->lastPage()}}

                                <!-- /.btn-group -->
                            </div>
                            <!-- /.pull-right -->
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody>
                                @forelse($mensagens as $msg)
                                    <tr>
                                        <td><input type="checkbox" name="lista" id="lista" value="{{$msg->id}}" v-model="msgCheck"></td>
                                        <td class="mailbox-name"><a href="/painel/mensagem/read/{{$msg->id}}">{{$msg->nome}}</a></td>
                                        <td class="mailbox-subject"><b>Formulário de contato</b> - {{str_limit($msg->mensagem, 55)}}
                                        </td>
                                        <td class="mailbox-attachment"></td>
                                        <td class="mailbox-date">{{$msg->created_at}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center">Caixa de mensagens vazia</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer no-padding">
                        <div class="mailbox-controls">

                            <div class="col-md-4 col-md-offset-3">
                                <?php
                                $currentPage = $mensagens->currentPage(); //Página actual
                                $maxPages = $currentPage + 3; //Máxima numeración de páginas
                                $firstPage = 1; //primera página
                                $lastPage = $mensagens->lastPage(); //última página
                                $nextPage = $currentPage+1; //Siguiente página
                                $forwardPage = $currentPage-1; //Página anterior
                                $mensagens->setPath('');
                                ?>
                                <ul class="pagination">
                                    <!-- Botón para navegar a la primera página -->
                                    <li class="@if($currentPage==$firstPage){{'disabled'}}@endif">
                                        <a href="@if($currentPage>1){{$mensagens->url($firstPage)}}{{$search != '' ? '&val='.$search : ''}}@else{{'#'}}@endif" class='btn'>Primera</a>
                                    </li>
                                    <!-- Botón para navegar a la página anterior -->
                                    <li class="@if($currentPage==$firstPage){{'disabled'}}@endif">
                                        <a href="@if($currentPage>1){{$mensagens->url($forwardPage)}}{{$search != '' ? '&val='.$search : ''}}@else{{'#'}}@endif" class='btn'>«</a>
                                    </li>
                                    <!-- Mostrar la numeración de páginas, partiendo de la página actual hasta el máximo definido en $maxPages -->
                                    @for($x=$currentPage;$x<$maxPages;$x++)
                                        @if($x <= $lastPage)
                                            <li class="@if($x==$currentPage){{'active'}}@endif">
                                                <a href="{{$mensagens->url($x)}}{{$search != '' ? '&val='.$search : ''}}" class='btn'>{{$x}}</a>
                                            </li>
                                    @endif
                                @endfor
                                <!-- Botón para navegar a la pagina siguiente -->
                                    <li class="@if($currentPage==$lastPage){{'disabled'}}@endif">
                                        <a href="@if($currentPage<$lastPage){{$mensagens->url($nextPage)}}{{$search != '' ? '&val='.$search : ''}}@else{{'#'}}@endif" class='btn'>»</a>
                                    </li>
                                    <!-- Botón para navegar a la última página -->
                                    <li class="@if($currentPage==$lastPage){{'disabled'}}@endif">
                                        <a href="@if($currentPage<$lastPage){{$mensagens->url($lastPage)}}{{$search != '' ? '&val='.$search : ''}}@else{{'#'}}@endif" class='btn'>Última</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="pull-right">
                                {{$mensagens->currentPage()}} de {{$mensagens->lastPage()}}

                                <!-- /.btn-group -->
                            </div>
                            <!-- /.pull-right -->
                        </div>
                    </div>
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

@endsection
