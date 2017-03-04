@extends('painel.templates.template')

@section('content')


    <section class="content-header">
        <h1>
            Serviços
            <small>cadastrar, editar e excluir serviços</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Serviços</li>
        </ol>
    </section>

    <section class="content">

        <!-- Default box -->
        <div class="box">

            <div class="box-body">

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


                <a href="/painel/user/add" class="btn btn-success">Novo Serviço</a>

                <br><br>

                <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
                    <tr>
                        <th>Titulo</th>
                        <th>texto</th>
                        <th>Ações</th>
                    </tr>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                </table>

            </div>

        </div>
        <!-- /.box-body -->

    </section>

@endsection
