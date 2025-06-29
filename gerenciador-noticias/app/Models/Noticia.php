<?php

// app/Models/Noticia.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    // Atualize o $fillable
    protected $fillable = [
        'titulo',
        'conteudo',
        'user_id',
        'category_id', // Adicione
        'image',       // Adicione
    ];

    public function user() { /* ... */ }

    // Adicione o relacionamento com Categoria
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
