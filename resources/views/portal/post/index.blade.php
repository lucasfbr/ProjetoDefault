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

            @if(count($posts) > 0)


                @foreach($posts as $post)
                    <div class="row portalPost">
                        <div class="col-md-10 col-md-offset-1 separador">
                            <div class="col-xs-12 col-md-6 col-lg-6">
                                <div class="thumbnail">
                                    <a href="/posts/show/{{$post->id}}">
                                        <img class="img-responsive" src="/{{$post->imagem}}"
                                             data-holder-rendered="true">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6 col-lg-6">

                                <div class="tituloPost">
                                    <p>
                                        <strong>categoria</strong>
                                        -
                                        <span class="dataPost">{{\Carbon\Carbon::parse($post->published_at)->diffForHumans()}}</span>
                                    </p>

                                    <h3><a href="/posts/show/{{$post->id}}">{{ str_limit($post->titulo, 25) }}</a></h3>
                                </div>
                                <div class="conteudoPost">
                                    <a href="/posts/show/{{$post->id}}">{!! str_limit($post->conteudo, 120) !!}</a>
                                    <br>
                                    <div class="row">
                                        <div class="postAutor col-xs-12">

                                            <div class="media">
                                                <div class="media-left">
                                                    <img class="media-object img-circle"
                                                         src="{{$post->user->foto ? $post->user->foto : '/img/default3.png'}}">
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading">{{$post->user->name}}</h4>
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
                        {!! $posts->render() !!}
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
