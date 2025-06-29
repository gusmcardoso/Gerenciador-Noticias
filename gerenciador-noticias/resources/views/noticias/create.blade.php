@extends('layouts.app', ['page' => __('Nova Notícia'), 'pageSlug' => 'noticias-create'])
@extends('layouts.app', ['page' => __('Nova Notícia'), 'pageSlug' => 'noticias'])
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="title">Criar Nova Notícia</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('noticias.store') }}">
                    @csrf
                    @include('noticias.partials.form')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
