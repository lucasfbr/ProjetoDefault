@extends('painel.templates.template')

@section('content')


    <section class="content-header">
        <h1>
            Configurações
            <small>cadastrar, editar e excluir configurações</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Configurações</li>
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
                @elseif(session('erro'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        {{ session('erro') }}
                    </div>
                @endif


                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingZero">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseZero"
                                   aria-expanded="true" aria-controls="collapseZero">
                                    Banners
                                </a>
                            </h4>
                        </div>

                        <div id="collapseZero" class="panel-collapse collapse in" role="tabpanel"
                             aria-labelledby="headingZero">
                            <div class="panel-body">
                                Abaixo será possivel gerenciar os banners da página principal

                                <hr>
                                @if(count($banners) > 0)
                                    <div class="row">

                                        @foreach($banners as $ban)
                                            <div class="col-sm-6 col-md-3">
                                                <div class="thumbnail">
                                                    <img alt="100%x200" data-src="holder.js/100%x200" style="height: 200px; width: 100%; display: block;" src="{{$ban->banner}}" data-holder-rendered="true">
                                                    <div class="caption">
                                                        <h3>{{ str_limit($ban->titulo, 20)}}</h3>
                                                        <p>{{ $ban->descricao }}</p>
                                                        <p><a href="/painel/banner/delete/{{$ban->id}}" onclick="return confirm('Realmente deseja excluir este registro?')" class="btn btn-default" role="button">Excluir</a></p>
                                                        <p><input type="checkbox" value="{{$ban->id}}" {{ $ban->status == '1' ? 'checked' : '' }} v-model="banners"> Ativar no slider</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                @else
                                    <div class="alert alert-info text-center col-md-6 col-md-offset-3">
                                        <h4>Nenhum banner cadastrado até o momento!</h4>
                                    </div>

                                @endif
                                <hr>

                                <form role="form" method="post" action="/painel/banner/create/"
                                      enctype="multipart/form-data">
                                {{ csrf_field() }}

                                    <div class="row">

                                        <div class="col-md-3 form-group">
                                            <label for="logo">Banner</label>
                                            <input type="file" id="banner" name="banner">

                                            <p class="help-block">Selecione uma imagem</p>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <input type="submit" class="btn btn-primary btn-block" value="Salvar" v-on:click="ativarBanner($event)">
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>


                    </div>



                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                   aria-expanded="false" aria-controls="collapseOne">
                                    Cabeçalho e Rodapé
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingOne">
                            <div class="panel-body">
                                Abaixo será possivel gerenciar todas as informações localizadas no cabeçalho e rodapé
                                do portal Paludo Consultoria

                                <hr>

                                <form role="form" method="post" action="/painel/configuracoes/update/{{$dados->id}}/1"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}


                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label for="titulo">Titulo</label>
                                            <input class="form-control" id="titulo" name="titulo" type="text"
                                                   value="{{ $dados->titulo }}"
                                                   autofocus>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="cep">Cep</label>
                                            <input class="form-control" id="cep" name="cep" type="text"
                                                   value="{{ $dados->cep }}"
                                                   autofocus
                                                   v-model="cep"
                                                   v-on:keyup="buscar"
                                                   data-inputmask='"mask": "99999-999"' data-mask>

                                            <p class="text-danger" style="display: none" v-show="naoLocalizado"><strong>Cep
                                                    não localizado</strong>. Preencha manualmente</p>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="uf">UF</label>
                                            <input class="form-control" id="uf" name="uf" type="text"
                                                   v-model="endereco.uf" value="{{ $dados->uf }}"
                                                   autofocus>


                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="cidade">Cidade</label>
                                            <input class="form-control" id="cidade" name="cidade" type="text"
                                                   v-model="endereco.localidade" value="{{ $dados->cidade }}"
                                                   autofocus>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-3 form-group">
                                            <label for="bairro">Bairro</label>
                                            <input class="form-control" id="bairro" name="bairro" type="text"
                                                   v-model="endereco.bairro" value="{{ $dados->bairro }}"
                                                   autofocus>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="logradouro">Logradouro</label>
                                            <input class="form-control" id="logradouro" name="logradouro" type="text"
                                                   v-model="endereco.logradouro" value="{{ $dados->logradouro }}"
                                                   autofocus>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="numero">Numero</label>
                                            <input class="form-control" id="numero" name="numero" type="text"
                                                   value="{{ $dados->numero }}"
                                                   v-el:numero
                                                   autofocus>
                                        </div>


                                        <div class="col-md-3 form-group">
                                            <label for="telefone">Telefone</label>
                                            <input class="form-control" id="telefone" name="telefone" type="text"
                                                   value="{{ $dados->telefone }}"
                                                   data-inputmask='"mask": "(99) 9999-9999"' data-mask
                                                   autofocus>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-3 form-group">
                                            <label for="logo">Logo Marca</label>
                                            <input type="file" id="logo" name="logo">

                                            <p class="help-block">Selecione sua logo</p>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <input type="submit" class="btn btn-primary btn-block" value="Salvar">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Redes Sociais e Google Maps
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingThree">
                            <div class="panel-body">
                                Gerencie suas redes sociais e o mapa localizado na página principal. Para alterar o
                                endereço
                                atual do mapa, você deve acessar o site do google maps e buscar pelo novo endereço, logo
                                após
                                copie o link que será gerado pelo site e cole no campo disponibilizado abaixo.

                                <hr>

                                <form class="form-horizontal" role="form" method="post"
                                      action="/painel/configuracoes/update/{{$dados->id}}/2"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="facebook" class="col-sm-1 control-label">Facebook</label>
                                        <div class="col-sm-11">
                                            <input type="text" class="form-control" id="facebook" name="facebook"
                                                   value="{{$dados->facebook}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="twitter" class="col-sm-1 control-label">Twitter</label>
                                        <div class="col-sm-11">
                                            <input type="text" class="form-control" id="twitter" name="twitter"
                                                   value="{{$dados->twitter}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="linkedin" class="col-sm-1 control-label">LinkedIn</label>
                                        <div class="col-sm-11">
                                            <input type="text" class="form-control" id="linkedin" name="linkedin"
                                                   value="{{$dados->linkedin}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="skype" class="col-sm-1 control-label">Skype</label>
                                        <div class="col-sm-11">
                                            <input type="text" class="form-control" id="skype" name="skype"
                                                   value="{{$dados->skype}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="google" class="col-sm-1 control-label">Google</label>
                                        <div class="col-sm-11">
                                            <input type="text" class="form-control" id="google" name="google"
                                                   value="{{$dados->google}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="youtube" class="col-sm-1 control-label">Youtube</label>
                                        <div class="col-sm-11">
                                            <input type="text" class="form-control" id="youtube" name="youtube"
                                                   value="{{$dados->youtube}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="googlemaps" class="col-sm-1 control-label">Google Maps</label>
                                        <div class="col-sm-11">
                                            <input type="text" class="form-control" id="googlemaps" name="googlemaps"
                                                   value="{{$dados->googlemaps}}">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <input type="submit" class="btn btn-primary btn-block" value="Salvar">
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Termos do contrato
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingTwo">
                            <div class="panel-body">

                                No editor abaixo você poderá definir todos os seus termos de contrato. Este texto será fornecido para o usuário que fizer um cadastro
                                no site. Este usuário não poderá se cadastrar se não aceitar os termos. Caso não queira ativer os termos de contrato basta deixar o campo
                                em branco.

                                <hr>

                                <form class="form-horizontal" role="form" method="post" action="/painel/configuracoes/update/{{$dados->id}}/3">
                                    {{ csrf_field() }}

                                    <textarea class="textarea" name="termosDeContrato" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $dados->termosDeContrato !!}</textarea>

                                    <br><br>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <input type="submit" class="btn btn-primary btn-block" value="Salvar">
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFour">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Formas de pagamento
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="headingFour">
                            <div class="panel-body">
                                O vendedor online que oferece o PagSeguro a seus clientes como meio de pagamento
                                facilita
                                sua vida e foge da burocracia, pois, não precisa negociar com cada um dos bancos e
                                administradoras de cartões para poder ser remunerado no pós-venda: você faz seu cadastro
                                gratuito no PagSeguro e automaticamente passa a receber das mais diversas instituições
                                financeiras por um só canal.

                                Outra vantagem é que você elimina o risco de perder vendas por não ter contrato com o
                                mesmo
                                banco do seu cliente e mesmo o comprador que não possui cartão de débito ou crédito pode
                                pagar por boleto ou fazer transferências bancárias para você. Se seu cliente usar o
                                PagSeguro e decidir pelo pagamento parcelado, sem problemas: você receberá à vista!
                            </div>
                        </div>
                    </div>

                </div>


            </div>

        </div>
        <!-- /.box-body -->

    </section>

@endsection

