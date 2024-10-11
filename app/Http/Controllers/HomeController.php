<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Show the application homepage with articles.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtener los artículos más recientes y paginarlos
        $posts = Post::latest()->paginate(6); 

        // Retornar la vista de inicio con los artículos
        return view('home', compact('posts'));
    }
}

