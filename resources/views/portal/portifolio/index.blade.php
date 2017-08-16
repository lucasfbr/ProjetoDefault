@extends('portal.templates.template')

@section('content')

    <!-- Titulo da pagina -->
    <div class="div_colorida">
        <div class="container ">
            <div class="row">
                <div class="page-header"><h1>Portifólio <small>conheça todos nossos trabalhos</small></h1></div>
            </div>
        </div>
    </div>
    <!-- Titulo da pagina -->


    <!-- Servicos -->
    <section id="portifolio">
        <div class="container">


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

                @else

                    <div class="row">
                        <div class="alert alert-info text-center">
                            <h4>Nenhum portifólio foi cadastrado até o momento. Acesse o seu painel administrativo e entre no menu portifólio, assim poderá cadastrar um portifólio</h4>
                        </div>
                    </div>

                @endif

        </div>
    </section>
    <!-- Fim Portifolio -->
    
@endsection
