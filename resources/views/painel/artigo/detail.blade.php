@extends('painel.templates.template')

@section('content')


        <section class="content-header">
            <h1>
                Artigos
                <small>cadastrar, editar e excluir Artigos</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="/painel/artigo">Artigos</a></li>
                <li class="active">Detalhes</li>
            </ol>
        </section>

        <section class="content">

            <!-- Default box -->
            <div class="box">

                <div class="box-body">

                    <div class="box box-widget">
                        <div class="box-header with-border">
                            <div class="user-block">
                                <img class="img-circle" src="/{{$user->foto ? $user->foto : 'img/default3.png'}}" alt="User Image">
                                <span class="username"><a href="#">{{$user->name}}</a></span>
                                <span class="description">Publicado - {{$user->created_at}}</span>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <div class="col-xs-12 col-md-9 col-lg-5">
                                <img class="img-responsive pad" src="/{{$artigo->imagem}}" alt="Photo">

                                <div class="text-justify">{!! $artigo->conteudo !!}</div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>




                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>

@endsection
