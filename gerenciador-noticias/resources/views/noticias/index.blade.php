@extends('layouts.app', ['page' => __('Gerenciamento de Notícias'), 'pageSlug' => 'noticias'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="card-title">Minhas Notícias</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('noticias.create') }}" class="btn btn-sm btn-primary">Adicionar Nova</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('alerts.success')

                <form action="{{ route('noticias.index') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Pesquisar por título..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="tim-icons icon-zoom-split"></i></button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table tablesorter">
                        <thead class="text-primary">
                            <tr>
                                <th style="width: 10%;">Imagem</th>
                                <th>Título</th>
                                <th>Categoria</th>
                                <th>Data de Criação</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($noticias as $noticia)
                            <tr>
                                <td>
                                    @if($noticia->image)
                                        <img src="{{ asset('storage/' . $noticia->image) }}" alt="Imagem da notícia" style="width: 80px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    @else
                                        <div style="width: 80px; height: 50px; background-color: #eee; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                            <i class="tim-icons icon-image-02" style="font-size: 24px; color: #888;"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $noticia->titulo }}</td>
                                <td>{{ $noticia->category->name ?? 'Sem categoria' }}</td>
                                <td>{{ $noticia->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-center">
                                    <form action="{{ route('noticias.destroy', $noticia) }}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir esta notícia?');" style="display: inline-block;">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('noticias.edit', $noticia) }}" class="btn btn-warning btn-sm btn-icon"><i class="tim-icons icon-pencil"></i></a>
                                        <button type="submit" class="btn btn-danger btn-sm btn-icon"><i class="tim-icons icon-simple-remove"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Nenhuma notícia encontrada.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $noticias->appends(request()->all())->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
