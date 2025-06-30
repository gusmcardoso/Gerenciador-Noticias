@extends('layouts.app', ['page' => __('Visualizar Notícia'), 'pageSlug' => 'noticias'])

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('Detalhes da Notícia') }}</h5>
            </div>
            <div class="card-body">
                @if($noticia->image)
                    <!-- Imagem em Destaque -->
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $noticia->image) }}" alt="Imagem da notícia" class="img-fluid" style="max-height: 400px; border-radius: 8px;">
                    </div>
                @endif

                <!-- Título da Notícia -->
                <h2 class="text-center mb-3">{{ $noticia->titulo }}</h2>

                <!-- Metadados: Categoria e Data -->
                <div class="text-center text-muted mb-4">
                    <span><strong>Categoria:</strong> {{ $noticia->category->name ?? 'Sem categoria' }}</span>
                    <span class="mx-2">|</span>
                    <span><strong>Publicado em:</strong> {{ $noticia->created_at->format('d/m/Y \à\s H:i') }}</span>
                </div>

                <hr>

                <!-- Conteúdo da Notícia -->
                <div class="mt-4" style="line-height: 1.8;">
                    {{-- Usamos {!! !!} para renderizar o HTML do editor de texto rico corretamente --}}
                    {!! $noticia->conteudo !!}
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('noticias.index') }}" class="btn btn-primary">Voltar para a Lista</a>
            </div>
        </div>
    </div>
</div>
@endsection
