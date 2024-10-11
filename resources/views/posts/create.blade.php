@extends('layouts.app')

@section('title', 'Crear Artículo')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Crear Nuevo Artículo</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="title">Título</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="content">Contenido</label>
                    <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="tags">Etiquetas</label>
                    <select name="tags[]" id="tags" class="form-control" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">
                        Para seleccionar múltiples etiquetas, mantén presionada la tecla Ctrl (Windows) o Cmd (Mac) mientras haces clic en las etiquetas deseadas.
                    </small>
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
