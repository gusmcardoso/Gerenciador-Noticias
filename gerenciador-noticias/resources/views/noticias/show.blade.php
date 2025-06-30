@extends('layouts.app', ['page' => __('Visualizar Notícia'), 'pageSlug' => 'noticias'])

@section('content')
<div class="card">
    <div class="card-header"><h5 class="title">Detalhes da Notícia</h5></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                @if($noticia->image)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $noticia->image) }}" alt="Imagem da notícia" class="img-fluid" style="border-radius: 8px;">
                    </div>
                @else
                    <div class="text-center mb-4 p-5" style="background-color: #f4f5f7; border-radius: 8px;">
                        <i class="tim-icons icon-image-02" style="font-size: 80px; color: #ccc;"></i>
                        <p class="text-muted mt-2">Nenhuma imagem disponível</p>
                    </div>
                @endif
                <hr>
                <h6 class="text-muted">Detalhes</h6>
                <div class="mb-2">
                    <strong>Categorias:</strong><br>
                    @forelse($noticia->categories as $category)
                        <span class="badge badge-info">{{ $category->name }}</span>
                    @empty
                        <span>Nenhuma</span>
                    @endforelse
                </div>
                <p>
                    <strong>Publicado em:</strong> {{ $noticia->created_at->format('d/m/Y \à\s H:i') }}<br>
                    <strong>Autor:</strong> {{ $noticia->user->name }}
                </p>
            </div>
            <div class="col-md-7">
                <h2 class="mb-3">{{ $noticia->titulo }}</h2>
                <hr>
                <div class="mt-4" style="line-height: 1.8; max-height: 60vh; overflow-y: auto;">
                    {!! $noticia->conteudo !!}
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-center">
        <a href="{{ route('noticias.index') }}" class="btn btn-primary">Voltar para a Lista</a>
        <a href="{{ route('noticias.edit', $noticia) }}" class="btn btn-warning">Editar Notícia</a>
    </div>
</div>
@endsection
