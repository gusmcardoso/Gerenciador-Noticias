@extends('layouts.app', ['page' => __('Editar Notícia'), 'pageSlug' => 'noticias-edit'])

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="title">Editar Notícia</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('noticias.update', $noticia) }}">
                    @csrf
                    @method('put')
                    @include('noticias.partials.form', ['noticia' => $noticia])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
