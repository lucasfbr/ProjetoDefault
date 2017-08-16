@extends('painel.templates.template')

@section('content')


    <section class="content-header">
        <h1>
            Consultores de <strong>{{$servico->titulo}}</strong>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>

    <section class="content">


        <div class="row">

            <div class="col-md-12">
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

                        <table class="table table-bordered table-striped table-hover table-condensed table-responsive">
                            <tr>
                                <th>
                                    Nome
                                </th>

                                <th>Ações</th>
                            </tr>

                            @forelse($users as $user)
                            <tr>
                                <td>{{ $user->name  }}</td>

                                <td width="180px">
                                    <a href="/painel/user/detail/" class="btn btn-sm btn-info"
                                       alt="Exibir o usuário" title="Exibir o usuário"><span
                                                class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </tr>
                            @empty
                                Nenhum registro enconttrado!
                            @endforelse

                        </table>



                    </div>

                </div>
            </div>
            <!-- /.box-body -->
        </div>

    </section>

@endsection
