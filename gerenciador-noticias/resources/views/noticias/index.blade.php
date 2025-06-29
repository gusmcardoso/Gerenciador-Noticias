@extends('layouts.app', ['page' => __('Gerenciamento de Notícias'), 'pageSlug' => 'noticias'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">Minhas Notícias</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('noticias.create') }}" class="btn btn-sm btn-primary">Adicionar Notícia</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                @include('alerts.success')

                <div class="row mb-3">
                    <div class="col-12">
                        <form action="{{ route('noticias.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Pesquisar por título..." value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Pesquisar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table tablesorter " id="">
                        <thead class=" text-primary">
                            <th>Título</th>
                            <th>Criação</th>
                            <th class="text-center">Ações</th>
                        </thead>
                        <tbody>
                            @forelse ($noticias as $noticia)
                            <tr>
                                <td>{{ $noticia->titulo }}</td>
                                <td>{{ $noticia->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-center">
                                     <form action="{{ route('noticias.destroy', $noticia) }}" method="post" onsubmit="return confirm('Tem certeza que deseja excluir esta notícia?');">
                                        @csrf
                                        @method('delete')
                                        <a href="{{ route('noticias.edit', $noticia) }}" class="btn btn-sm btn-warning">Editar</a>
                                        <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Nenhuma notícia encontrada.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $noticias->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
