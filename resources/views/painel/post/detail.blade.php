@extends('painel.templates.template')

@section('content')


        <section class="content-header">
            <h1>
                Posts
                <small>cadastrar, editar e excluir posts</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="/painel/post">Posts</a></li>
                <li class="active">Detalhes</li>
            </ol>
        </section>

        <section class="content">

            <!-- Default box -->
            <div class="box">

                <div class="box-body">

                    <h1>{{ $post->titulo }}</h1>

                    {!! $post->conteudo !!}

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>

@endsection
