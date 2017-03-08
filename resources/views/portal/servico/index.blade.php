@extends('portal.templates.template')

@section('content')

    <!-- Titulo da pagina -->
    <div class="div_colorida">
        <div class="container ">
            <div class="row">
                <div class="page-header"><h1>Serviços <small>Conheca nossas especialidades</small></h1></div>
            </div>
        </div>
    </div>
    <!-- Titulo da pagina -->


    <!-- Servicos -->
    <section id="servicos">
        <div class="container">

            @forelse($servicos as $key => $servico)

                @if((($key)%2) == 0)
                    <div class="row page-servicos-row">
                        @endif
                        <div class="col-xs-12 col-md-6">

                            <div class="col-md-6">
                                <img src="/{{$servico->imagem}}" class="img-responsive img-circle">
                            </div>
                            <div class="col-md-6">
                                <h5>{{$servico->titulo}}</h5>
                                <p class="text-justify">
                                    {{ $servico->texto }}
                                </p>
                            </div>
                        </div>

                        @if((($key)%2) == 1)
                    </div>
                @endif
            @empty
                <div class="row page-servicos-row">
                    <div class="col-xs-12">
                        <h4>Nenhum serviço cadastrado!</h4>
                    </div>

                </div>
            @endforelse

        </div>
    </section>
    <!-- Fim Servicos -->
    
@endsection
