@extends('portal.templates.template')

@section('content')


    <!-- Titulo da pagina -->
    <div class="div_colorida">
        <div class="container ">
            <div class="row">
                <div class="page-header">
                    <h1>Artigos
                        <small>lista de artigos dos nossos consultores</small>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Titulo da pagina -->


    <!-- Servicos -->
    <section id="servicos">
        <div class="container">

            @if(count($artigos) > 0)


                @foreach($artigos as $artigo)
                    <div class="row portalartigo">
                        <div class="col-md-10 col-md-offset-1 separador">
                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <div class="thumbnail">
                                    <a href="/artigos/show/{{$artigo->id}}">
                                        <img class="img-responsive" src="/{{$artigo->imagem}}"
                                             data-holder-rendered="true">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6">

                                <div class="tituloArtigo">
                                    <p>
                                        <strong>{{$artigo->categoria->titulo}}</strong>
                                        -
                                        <span class="dataartigo">{{\Carbon\Carbon::parse($artigo->published_at)->diffForHumans()}}</span>
                                    </p>

                                    <h3><a href="/artigos/show/{{$artigo->id}}">{{ str_limit($artigo->titulo, 25) }}</a></h3>
                                </div>
                                <div class="conteudoArtigo">
                                    <a href="/artigos/show/{{$artigo->id}}">{!! str_limit($artigo->conteudo, 120) !!}</a>
                                    <br>
                                    <div class="row">
                                        <div class="artigoAutor col-xs-12">

                                            <div class="media">
                                                <div class="media-left">
                                                    <img class="media-object img-circle"
                                                         src="{{$artigo->user->foto ? $artigo->user->foto : '/img/default3.png'}}">
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">{{$artigo->user->name}}</h4>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
                    <div class="col-xs-12">
                        {!! $artigos->render() !!}
                    </div>

            @else
                <div class="alert alert-info text-center col-md-6 col-md-offset-3">
                    <h4>Nenhum artigo foi cadastrado até o momento!</h4>
                </div>

            @endif

        </div>
    </section>
    <!-- Fim Servicos -->


@endsection
