<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Define o relacionamento de muitos-para-muitos com a Notícia.
     */
    public function noticias()
    {
        return $this->belongsToMany(Noticia::class);
    }
}
