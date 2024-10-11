<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'users_id'];

    /**
     * Un post pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * Un post puede tener múltiples etiquetas.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'posts_id', 'tags_id');
    }
}
