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


            <div class="row">
                <div class="col-xs-12 col-lg-10 col-lg-offset-1">
                    <div class="col-xs-12 tituloArtigo">
                        <p>
                            <strong>{{$artigo->categoria->titulo}}</strong>
                            -
                            <span class="dataArtigo">{{\Carbon\Carbon::parse($artigo->published_at)->diffForHumans()}}</span>
                        </p>

                        <h3><a href="/artigos/show/{{$artigo->id}}">{{$artigo->titulo}}</a></h3>
                    </div>

                    <div class="col-xs-12 artigoImg">
                        <img class="img-responsive" src="/{{$artigo->imagem}}" data-holder-rendered="true">
                    </div>

                    <div class="conteudoArtigo col-xs-12 text-justify">
                        {!! $artigo->conteudo !!}
                    </div>
                </div>
            </div>


        </div>
    </section>
    <!-- Fim Servicos -->


@endsection
