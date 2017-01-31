@extends('painel.templates.template')

@section('content')


    <section class="content-header">
        <h1>
            Posts
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/painel"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="/painel/post">Posts</li>
            <li class="active">Cadastro</li>
        </ol>
    </section>

    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">


                <div class="box-header with-border">
                    <h3 class="box-title">Cadatre um novo post</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="/painel/post/create">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input class="form-control" id="titulo" name="titulo" placeholder="Título do post" type="text">
                        </div>
                        <div class="form-group">
                            <label>Conteúdo</label>
                            <textarea class="form-control" rows="3" id="conteudo" name="conteudo" placeholder="Conteúdo do post"></textarea>
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
