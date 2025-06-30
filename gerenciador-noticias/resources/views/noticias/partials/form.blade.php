@include('alerts.errors')

<div class="form-group">
    <label>{{ __('Título') }}</label>
    <input type="text" name="titulo" class="form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" value="{{ old('titulo', $noticia->titulo ?? '') }}" required>
</div>

<div class="form-group">
    <label>{{ __('Categorias') }}</label>
    <select name="categories[]" class="form-control select2-form{{ $errors->has('categories') ? ' is-invalid' : '' }}" multiple="multiple" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                @if(isset($noticia) && $noticia->categories->contains($category->id)) selected @endif
                @if(is_array(old('categories')) && in_array($category->id, old('categories'))) selected @endif
                >
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
    <textarea id="editor" rows="10" name="conteudo">{{ old('conteudo', $noticia->conteudo ?? '') }}</textarea>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-fill btn-primary">{{ __('Salvar') }}</button>
</div>

@push('js')
<script>
    $(document).ready(function() {
        // Inicializa o Select2 para o formulário
        $('.select2-form').select2({
            theme: "classic",
            placeholder: "Selecione uma ou mais categorias",
            allowClear: true
        });

        // Inicializa o TinyMCE
        tinymce.init({
            selector: '#editor',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            height: 300
        });
    });
</script>
@endpush
