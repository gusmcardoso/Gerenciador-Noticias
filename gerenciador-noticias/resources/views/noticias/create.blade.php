@extends('layouts.app', ['page' => __('Nova Notícia'), 'pageSlug' => 'noticias'])

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('Criar Nova Notícia') }}</h5>
            </div>
            <!-- Adicione o enctype aqui -->
            <form method="post" action="{{ route('noticias.store') }}" autocomplete="off" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    @include('noticias.partials.form')
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
