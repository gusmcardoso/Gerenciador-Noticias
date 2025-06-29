@extends('layouts.app', ['page' => __('Editar Notícia'), 'pageSlug' => 'noticias'])

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('Editar Notícia') }}</h5>
            </div>
            <!-- Adicione o enctype aqui -->
            <form method="post" action="{{ route('noticias.update', $noticia) }}" autocomplete="off" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    @method('put')
                    @include('noticias.partials.form')
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
