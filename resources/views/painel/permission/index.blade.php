@extends('painel.templates.template')

@section('content')

    <section class="content-header">
        <h1>
            Permissões
            <small>Gerencie as permissões de cada função</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="#">Permissões</a></li>
        </ol>
    </section>

    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-body">

                <div class="row">
                    <div class="col-xs-12">

                            <div class="box-header">
                                <h3 class="box-title">Lista de permissões</h3>

                                <div class="box-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input name="table_search" class="form-control pull-right" placeholder="Buscar" type="text">

                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tbody><tr>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Ações</th>
                                    </tr>
                                    @forelse($permissions as $perm)
                                    <tr>
                                        <td>{{$perm->name}}</td>
                                        <td>{{$perm->label}}</td>
                                        <td>
                                            <a href="/painel/permissoes/role" class="btn btn-success" title="Visualizar funções desta permissão" alt="Cadastrar uma nova funçã"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            <a href="/painel/permissoes/edit" class="btn btn-warning" title="Editar permissão" alt="Cadastrar uma nova funçã"><i class="fa fa-wrench" aria-hidden="true"></i></a>
                                            <a href="/painel/permissoes/delete" class="btn btn-danger" title="Excluir permissão" alt="Cadastrar uma nova funçã"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="90">
                                                <h4 class="text-center">Nenhuma permissão cadastrada até o momento!</h4>
                                            </td>
                                        </tr>
                                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                Footer
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>

@endsection
