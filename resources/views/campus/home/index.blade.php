@extends('campus.templates.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @forelse($posts as $post)
                        @can('post_view', $post)
                            <h1>{{$post->titulo}}</h1>
                            <p>{{$post->conteudo}}</p>
                            <p><strong>Autor:</strong>  {{$post->user->name}}</p>

                                <p><a href="{{url("/post/update/$post->id")}}">Editar</a></p>

                            <hr>
                        @endcan
                    @empty
                        <p>Nenhum Post cadastrado</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
