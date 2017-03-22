@extends('portal.templates.template')

@section('content')


    <!-- Titulo da pagina -->
    <div class="div_colorida">
        <div class="container ">
            <div class="row">
                <div class="page-header"><h1>Posts <small>lista de posts dos nossos consultores</small></h1></div>
            </div>
        </div>
    </div>
    <!-- Titulo da pagina -->


    <!-- Servicos -->
    <section id="servicos">
        <div class="container">

            @if(count($posts) > 0)
                <div class="row">

                    @foreach($posts as $post)
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="thumbnail">
                                    <img class="img-responsive" src="/{{$post->imagem}}" data-holder-rendered="true">
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="usuarioPost">
                                    <img class="img-circle img-responsive" src="/{{$post->user->foto ? $post->user->foto : 'img/default3.png'}}" data-holder-rendered="true">
                                    <p class="dataPublicacao">{{$post->published_at}}</p>
                                </div>
                                <div class="tituloPost">
                                    <h3>{{$post->titulo}}</h3>
                                </div>
                                <div class="conteudoPost">
                                    {!! $post->conteudo !!}
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            @else
                <div class="alert alert-info text-center col-md-6 col-md-offset-3">
                    <h4>Nenhum post foi cadastrado até o momento!</h4>
                </div>

            @endif

        </div>
    </section>
    <!-- Fim Servicos -->

    
@endsection
