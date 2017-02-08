@extends('painel.templates.template')

@section('content')


        <section class="content-header">
            <h1>
                Usuários
                <small>detalhes do usuário</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="/painel/user">Usuários</a></li>
                <li class="active">Detalhes</li>
            </ol>
        </section>

        <section class="content">

            <!-- Default box -->
            <div class="box">

                <div class="box-body">

                    <h1>{{ $user->name }}</h1>

                    {!! $user->email !!}

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>

@endsection
