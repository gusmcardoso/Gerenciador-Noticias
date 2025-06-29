@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label>Título</label>
    <input type="text" name="titulo" class="form-control" placeholder="Título da notícia" value="{{ old('titulo', $noticia->titulo ?? '') }}" required>
</div>

<div class="form-group">
    <label>Conteúdo</label>
    <textarea rows="4" class="form-control" name="conteudo" placeholder="Escreva o conteúdo aqui..." required>{{ old('conteudo', $noticia->conteudo ?? '') }}</textarea>
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-fill btn-primary">Salvar</button>
    <a href="{{ route('noticias.index') }}" class="btn btn-fill btn-default">Cancelar</a>
</div>
