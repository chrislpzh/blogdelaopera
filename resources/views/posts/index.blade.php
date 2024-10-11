@extends('layouts.app')

@section('title', 'Artículos')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Artículos</h2>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">Crear</a>
        </div>
        <div class="card-body">

            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            
            <div class="d-flex justify-content-between mb-3">
                <div class="form-group">
                    <label for="entries">Mostrar</label>
                    <form action="{{ route('posts.index') }}" method="GET" style="display: inline-block;">
                        <select name="entries" id="entries" onchange="this.form.submit()" class="form-control form-control-sm" style="width: auto; display: inline-block;">
                            <option value="5" {{ request('entries') == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ request('entries') == 20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                        <span>entradas</span>
                    </form>
                </div>

                
                <form method="GET" action="{{ route('posts.index') }}" class="form-inline">
                    <input type="hidden" name="entries" value="{{ request('entries', 10) }}">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Buscar..." value="{{ request()->query('search') }}">
                    <button type="submit" class="btn btn-sm btn-primary ml-2">Buscar</button>
                </form>
            </div>

            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user?->name ?? 'Usuario no asignado' }}</td>
                        <td>
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-primary">Editar artículo</a>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este artículo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Mostrando {{ $posts->firstItem() ?? 0 }} a {{ $posts->lastItem() ?? 0 }} de {{ $posts->total() }} entradas
                </div>
                <div>
                    <!-- Mostrar paginación personalizada si hay solo una página -->
                    @if ($posts->hasPages())
                        <nav aria-label="Page navigation">
                            {{ $posts->links() }}
                        </nav>
                    @else
                        <!-- Diseño de paginación para una sola página -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item disabled"><span class="page-link">Anterior</span></li>
                                <li class="page-item active"><span class="page-link">1</span></li>
                                <li class="page-item disabled"><span class="page-link">Siguiente</span></li>
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



