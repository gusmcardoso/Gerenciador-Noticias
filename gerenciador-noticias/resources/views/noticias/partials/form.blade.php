@include('alerts.errors')

<div class="form-group">
    <label>{{ __('Título') }}</label>
    <input type="text" name="titulo" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" placeholder="{{ __('Título da notícia') }}" value="{{ old('titulo', $noticia->titulo ?? '') }}" required>
</div>

<div class="form-group">
    <label>{{ __('Categoria') }}</label>
    <select name="category_id" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" required>
        <option value="">Selecione uma categoria</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ (isset($noticia) && $noticia->category_id == $category->id) || old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>{{ __('Imagem de Destaque') }}</label>
    <input type="file" name="image" class="form-control-file{{ $errors->has('image') ? ' is-invalid' : '' }}">
    @if(isset($noticia) && $noticia->image)
        <div class="mt-2">
            <p>Imagem atual:</p>
            <img src="{{ asset('storage/' . $noticia->image) }}" alt="Imagem da notícia" style="max-width: 200px; border-radius: 8px;">
        </div>
    @endif
</div>


<div class="form-group">
    <label>{{ __('Conteúdo') }}</label>
    <textarea id="editor" rows="10" class="form-control{{ $errors->has('conteudo') ? ' is-invalid' : '' }}" name="conteudo" placeholder="{{ __('Escreva o conteúdo aqui...') }}">{{ old('conteudo', $noticia->conteudo ?? '') }}</textarea>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-fill btn-primary">{{ __('Salvar') }}</button>
    <a href="{{ route('noticias.index') }}" class="btn btn-fill btn-default">{{ __('Cancelar') }}</a>
</div>

<!-- Script para inicializar o TinyMCE -->
<script>
    tinymce.init({
        selector: '#editor',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 400
    });
</script>
