@extends('portal.templates.template')

@section('content')


    <!-- Titulo da pagina -->
    <div class="div_colorida">
        <div class="container ">
            <div class="row">
                <div class="page-header">
                    <h1>Posts
                        <small>lista de posts dos nossos consultores</small>
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


                    <div class="col-xs-12 tituloPost">
                        <p>
                            <strong>categoria</strong>
                            -
                            <span class="dataPost">{{\Carbon\Carbon::parse($post->published_at)->diffForHumans()}}</span>
                        </p>

                        <h3><a href="/posts/show/{{$post->id}}">{{$post->titulo}}</a></h3>
                    </div>

                    <div class="col-xs-12">
                        <img class="img-responsive" src="/{{$post->imagem}}" data-holder-rendered="true">
                    </div>

                    <div class="conteudoPost col-xs-12 text-justify">
                        {!! $post->conteudo !!}
                    </div>



                </div>
            </div>


        </div>
    </section>
    <!-- Fim Servicos -->


@endsection
