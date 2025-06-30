<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'conteudo',
        'user_id',
        'image',
    ];

    /**
     * Define o relacionamento com o usuário (Autor).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define o relacionamento de muitos-para-muitos com a Categoria.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
