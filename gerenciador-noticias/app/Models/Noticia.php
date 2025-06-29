<?php

// app/Models/Noticia.php
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
    ];

    /**
     * Define a relação de pertencimento a um usuário.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
