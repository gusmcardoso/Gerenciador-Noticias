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

                <form action="{{ route('noticias.index') }}" method="GET" class="mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="search">Pesquisar por Título</label>
                                <input type="text" id="search" name="search" class="form-control" placeholder="Digite o título..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="category_ids">Filtrar por Categorias</label>
                                <select id="category_ids" name="category_ids[]" class="form-control select2-filter" multiple="multiple">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ (is_array(request('category_ids')) && in_array($category->id, request('category_ids'))) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="date_from">Data Inicial</label>
                                <input type="date" id="date_from" name="date_from" class="form-control" value="{{ request('date_from') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="date_to">Data Final</label>
                                <input type="date" id="date_to" name="date_to" class="form-control" value="{{ request('date_to') }}">
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <div class="form-group w-100">
                               <button class="btn btn-primary btn-block" type="submit">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="table-responsive" style="overflow-x: auto; overflow-y: visible;">
                    <table class="table tablesorter">
                        <thead class="text-primary">
                            <tr>
                                <th style="width: 10%;">Imagem</th>
                                <th>Título</th>
                                <th>Categorias</th>
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
                                <td>
                                    @forelse($noticia->categories as $category)
                                        <span class="badge badge-primary">{{ $category->name }}</span>
                                    @empty
                                        <span class="badge badge-secondary">Sem categoria</span>
                                    @endforelse
                                </td>
                                <td>{{ $noticia->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="tim-icons icon-settings-gear-63"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('noticias.show', $noticia) }}">
                                                <i class="tim-icons icon-zoom-split"></i> Visualizar
                                            </a>
                                            <a class="dropdown-item" href="{{ route('noticias.edit', $noticia) }}">
                                                <i class="tim-icons icon-pencil"></i> Editar
                                            </a>
                                            <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); if(confirm('Tem certeza que deseja excluir esta notícia?')) { document.getElementById('delete-form-{{ $noticia->id }}').submit(); }">
                                                <i class="tim-icons icon-simple-remove"></i> Excluir
                                            </a>
                                        </div>
                                    </div>
                                    <form id="delete-form-{{ $noticia->id }}" action="{{ route('noticias.destroy', $noticia) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
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

@push('js')
<script>
    $(document).ready(function() {
        // Inicializa o Select2 para o filtro de categorias
        $('.select2-filter').select2({
            theme: "classic",
            placeholder: "Filtrar por categorias",
            allowClear: true
        });
    });
</script>
@endpush
