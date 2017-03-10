@extends('portal.templates.template')

@section('content')

    <!-- Titulo da pagina -->
    <div class="div_colorida">
        <div class="container ">
            <div class="row">
                <div class="page-header"><h1>Quem Somos</h1></div>
            </div>
        </div>
    </div>
    <!-- Titulo da pagina -->


    <!-- Quem somos -->
    <section id="quemsomosdetalhes">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-xs-12 col-sm=4 col-md-4 ">
                        <img src="{{$perfil->foto_perfil}}" class="img-responsive">
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8">

                        <div class="col-xs-12 quemsomosSobremim">
                            <h4>Sobre Mim</h4>
                            <p>
                                {{$perfil->resumo}}
                            </p>
                        </div>

                        <div class="col-xs-12">
                            <p>
                                {{$perfil->descricao}}
                            </p>
                        </div>

                        <div class="col-xs-6 btn-todos">
                            <a href="#" class="btn btn-primary btn-lg">Entre em contato</a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="quemsomosdetalhes" class="div_colorida">

        <div class="container ">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row formacao ">
                        <div class="col-xs-12">
                            <h2 class="">Formação</h2>

                            <ul class="timeline">


                                @foreach($formacao as $form)
                                <!-- timeline time label -->
                                    <li class="time-label">
                                        <span class="bg-blue">
                                            {{$form->dataFormacao}}
                                        </span>
                                    </li>
                                    <!-- /.timeline-label -->

                                    <!-- timeline item -->
                                    <li>
                                        <!-- timeline icon -->
                                        <i class="fa fa-graduation-cap bg-blue"></i>
                                        <div class="timeline-item">

                                            <h3 class="timeline-header">{{$form->titulo}}</h3>

                                            <div class="timeline-body">
                                                {{$form->conteudo}}
                                            </div>

                                            <div class="timeline-footer">
                                                <a class="btn btn-primary btn-xs">...</a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
         </div>

    </section>

    <!-- FimQuem somos -->

@endsection
