<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    // Obtener el número de entradas a mostrar
    $perPage = $request->input('entries', 10);

    // Construir la consulta con la búsqueda
    $query = Post::with('user');

    if ($request->has('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    // Paginar los resultados según el número de entradas seleccionadas
    $posts = $query->paginate($perPage);

    return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtencion de todas las etiquetas para asignarlas en el formulario de creación
        $tags = Tag::all();
        return view('posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación los datos
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'tags' => 'array' 
        ]);

        // Crear el post con los datos del formulario y se asigna el usuario autenticado
        $post = Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'users_id' => Auth::id()
        ]);

        // Sincronizar las etiquetas si se seleccionaron
        if ($request->has('tags')) {
            $post->tags()->sync($validatedData['tags']);
        }

        return redirect()->route('posts.index')->with('success', 'Artículo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mostrar un post específico
        $post = Post::with('user', 'tags')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Obtención del post y las etiquetas para el formulario de edición
        $post = Post::findOrFail($id);
        $tags = Tag::all();

        return view('posts.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'tags' => 'array' // Debe ser un arreglo para manejar múltiples etiquetas
        ]);

        // Actualización del post
        $post = Post::findOrFail($id);
        $post->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content']
        ]);

        // Sincronizsción las etiquetas
        if ($request->has('tags')) {
            $post->tags()->sync($validatedData['tags']);
        } else {
            $post->tags()->detach(); // Si no hay etiquetas, se eliminan todas
        }

        return redirect()->route('posts.index')->with('success', 'Artículo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Eliminamos el post
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Artículo eliminado correctamente.');
    }
}
