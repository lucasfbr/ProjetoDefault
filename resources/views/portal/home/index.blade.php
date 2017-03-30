@extends('portal.templates.template')

@section('content')

    <div class="divslider">

        <!-- Slider da aplicacao -->
        <div id="sliderprincipal" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#sliderprincipal" data-slide-to="0" class="active"></li>
                <li data-target="#sliderprincipal" data-slide-to="1"></li>
                <li data-target="#sliderprincipal" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

                @if(count($banners) > 0)

                    @foreach($banners as $key => $ban)
                        <div class="item {{$key == '0' ? 'active' : ''}}">
                            <img src="{{$ban->banner}}" class="img-responsive" alt="...">
                            <div class="carousel-caption">
                                <h3>{{$ban->titulo}}</h3>
                                <p>{{$ban->descricao}}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                        <div class="item active">
                            <img src="/img/default.png" class="img-responsive" alt="...">
                            <div class="carousel-caption">
                                <h3>Foto 1</h3>
                                <p>Descricao da foto</p>
                            </div>
                        </div>
                        <div class="item">
                            <img src="/img/default.png" class="img-responsive" alt="...">
                            <div class="carousel-caption">
                                <h3>Foto 2</h3>
                                <p>Descricao da foto</p>
                            </div>
                        </div>
                        <div class="item">
                            <img src="/img/default.png" class="img-responsive" alt="...">
                            <div class="carousel-caption">
                                <h3>Foto 3</h3>
                                <p>Descricao da foto</p>
                            </div>
                        </div>
                @endif

            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#sliderprincipal" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#sliderprincipal" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!-- Fim Slider da aplicacao -->
    </div>

    <!-- Servicos -->
    <section id="servicos">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                        <h1>Servicos
                            <small>conheça oque fazemos</small>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="row">

             @if(count($servicos) > 0)
                @foreach($servicos as $servico)
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 servicos_item">
                        <div><img src="/{{$servico->imagem}}" class="img-responsive img-circle"></div>
                        <h4>{{$servico->titulo}}</h4>
                        <p>{{ $servico->resumo }}</p>
                    </div>
                @endforeach

                </div>

                <div class="row">
                    <div class="col-xs-12 text-center btn-todos">
                        <a href="/servicos" class="btn btn-default btn-lg">Veja todos nossos servicos</a>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="alert alert-info text-center">
                        <h4>Nenhum registro cadastrado para "Serviços"</h4>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- Fim Servicos -->

    <!-- Portifolio -->
    <section id="portifolio" class="div_colorida">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                        <h1>Portifólio
                            <small>conheça nossos trabalhos</small>
                        </h1>
                    </div>
                </div>
            </div>

            @if(count($portifolio) > 0)

                <div class="row portifolio-row">
                    @foreach($portifolio as $porti)
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="portifolio_item">
                                <div><img style="height: 200px; width: 100%; display: block;" src="/{{$porti->imagem}}" class="img-responsive"></div>
                                <h4>{{$porti->titulo}}</h4>
                            </div>
                        </div>
                    @endforeach
                </div>


                <div class="row">
                    <div class="col-xs-12 text-center btn-todos">
                        <a href="/portifolio" class="btn btn-default btn-lg">Veja o portifólio completo</a>
                    </div>
                </div>
            @else

                <div class="row">
                    <div class="alert alert-info text-center">
                        <h4>Nenhum registro cadastrado para "Portifólio"</h4>
                    </div>
                </div>

            @endif

        </div>
    </section>
    <!-- Fim Portifolio -->

    <!-- Quem somos -->
    <section id="quemsomos">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                        <h1>Quem Somos
                            <small>conheça nossa história</small>
                        </h1>
                    </div>
                </div>
            </div>

            @if(count($quemsomos) > 0)

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 row-quemSomos">
                        <div class="col-sm-8 text-right">

                            <h4>{{$quemsomos[0]->titulo_sobre}}</h4>

                            <p>
                                {{$quemsomos[0]->texto_sobre}}
                            </p>
                        </div>
                        <div class="col-sm-4">
                            <img src="/{{$quemsomos[0]->imagem_sobre}}" class="img-responsive img-rounded quemSomos-img">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="col-sm-4">
                            <img src="/{{$quemsomos[0]->imagem_missao}}" class="img-responsive img-rounded quemSomos-img">
                        </div>
                        <div class="col-sm-8 text-left">
                            <h4>{{$quemsomos[0]->titulo_missao}}</h4>
                            <p>
                                {{$quemsomos[0]->texto_missao}}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 text-center btn-todos">
                        <a href="/quemsomos" class="btn btn-default btn-lg">Veja mais</a>
                    </div>
                </div>

            @else

                <div class="row">
                    <div class="alert alert-info text-center">
                        <h4>Nenhum registro cadastrado para "Quem somos"</h4>
                    </div>
                </div>

            @endif

        </div>
    </section>
    <!-- FimQuem somos -->

    <!-- Nossa equipe -->
    <section id="nossa-equipe" class="div_colorida">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                        <h1>Nossa Equipe
                            <small>conheça nossos consultores</small>
                        </h1>
                    </div>
                </div>
            </div>

            @if(count($nossaEquipe) > 0)
                @foreach($nossaEquipe as $equipe)
                <div class="row nossaEquipe-item">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 servicos_item">
                        <div><img src="{{$equipe->foto ? $equipe->foto : '/img/foto.jpg'}}" class="img-responsive img-circle"></div>
                        <h4>{{$equipe->name}}</h4>
                        <p>{{$equipe->perfis ? $equipe->perfis->resumo : ''}}</p>
                    </div>
                </div>
                @endforeach
            @else

                <div class="row">
                    <div class="alert alert-info text-center">
                        <h4>Nenhum registro cadastrado para "Nossa Equipe"</h4>
                    </div>
                </div>

            @endif
        </div>
    </section>
    <!-- Fim nossa equipe -->

    <!-- Localizacao -->
    <section id="localizacao">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                        <h1>Localizacao
                            <small>veja onde estamos</small>
                        </h1>
                    </div>
                </div>
            </div>
            @if(info_sistem()->googlemaps)
                <div class="row">
                    <div class="col-xs-12">
                        <iframe src="{{info_sistem()->googlemaps}}"
                                width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="alert alert-info text-center">
                        <h4>Nenhum mapa cadastrado até o momento!</h4>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!-- Fim Localizacao -->

    <!-- Contato -->
    <section id="contato" class="div_colorida">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                        <h1>Contato
                            <small>mande suas duvidas</small>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="row contato">
                <div class="col-xs-12">
                    <p class="bg-success aviso">
                        Preencha o formulário abaixo para entrar em contato conosco!
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <form name="frmContato" id="frmContato" method="post" action="/mensagens/create">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                                    <input type="text" class="form-control input-lg" name="nome" id="nome"
                                           placeholder="Qual é seu nome?" value="{{ old('nome') }}">

                                    @if ($errors->has('nome'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nome') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input type="text" class="form-control input-lg" name="email" id="email"
                                           placeholder="Qual o seu email?" value="{{ old('email') }}" >

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control input-lg" name="telefone" id="telefone"
                                           placeholder="Qual o seu telefone?" value="{{ old('telefone') }}"  data-inputmask='"mask": "(99)99999-9999"' data-mask>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('mensagem') ? ' has-error' : '' }}">
                                    <textarea class="form-control input-lg" name="mensagem" id="mensagem"
                                          placeholder="Sua mensagem!" rows="6">{{ old('mensagem') }}</textarea>

                                    @if ($errors->has('mensagem'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('mensagem') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            @if (session('sucesso'))
                                <div class="col-md-6">
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        {{ session('sucesso') }}
                                    </div>
                                </div>
                            @elseif(session('erro'))
                                <div class="col-md-6">
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        {{ session('erro') }}
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-6">
                                <button type="submit" class="btn btn-default btn-lg">Enviar Formulário</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Fim Contato -->
    
@endsection
