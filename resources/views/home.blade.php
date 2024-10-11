@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Banner promocional -->
    <div class="promo-banner bg-success text-white py-4 text-center" style="padding-top: 0px;">
        <p class="mb-0">Si estás interesado en más sobre la ópera, explora nuestro blog donde encontrarás más de 1000 artículos</p>
    </div>

    <!-- Búsqueda y categorías centrados -->
    <div class="header-bar bg-dark text-white py-3">
        <div class="container d-flex flex-column align-items-center">
            <h1 class="text-uppercase fw-bold font-weight-bold mb-3 text-center">Ópera Blog</h1>
            <nav class="d-flex justify-content-center">
                <a href="#" class="text-white text-decoration-none px-3 border-end">Compositores</a>
                <a href="#" class="text-white text-decoration-none px-3 border-end">Artes Escénicas</a>
                <a href="#" class="text-white text-decoration-none px-3 border-end">Historia</a>
                <a href="#" class="text-white text-decoration-none px-3">Críticas</a>
            </nav>
        </div>
    </div>

    <!-- Barra de búsqueda -->
    <div class="search-bar bg-light py-4">
        <div class="container">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar en el blog...">
                <select class="form-select">
                    <option selected>Categoría</option>
                    <option value="1">Compositores</option>
                    <option value="2">Óperas</option>
                    <option value="3">Instrumentación</option>
                </select>
                <button class="btn btn-dark" type="button">Buscar</button>
            </div>
        </div>
    </div>

    <!-- Contenido de artículos -->
    <h2 class="mb-4 mt-5">Artículos Recientes</h2>
    <div class="row">
        @foreach($posts as $index => $post)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('images/posts/articulo' . ($index + 1) . '.jpg') }}" class="card-img-top" alt="Imagen del artículo" onerror="this.src='{{ asset('images/posts/default.jpg') }}'">
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $post->title }}</h5> <!-- Título en negrita -->
                    <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                    
                    <!-- Mostrar etiquetas del artículo -->
                    <div class="mb-2">
                        @foreach($post->tags as $tag)
                            <span class="badge text-white" style="background-color: #28a745;">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    
                    <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Leer más</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>

<!-- Banner de pie de página -->
<div class="footer-banner bg-secondary text-white py-4 mt-5">
    <div class="container text-center">
        <small>&copy; 2024 Ópera Blog. Todos los derechos reservados.</small>
        <nav class="d-flex justify-content-center mt-2">
            <a href="#" class="text-white text-decoration-none px-3">Ayuda</a>
            <a href="#" class="text-white text-decoration-none px-3">Recursos</a>
            <a href="#" class="text-white text-decoration-none px-3">Términos y Condiciones</a>
            <a href="#" class="text-white text-decoration-none px-3">Política de Privacidad</a>
        </nav>
    </div>
</div>
@endsection






