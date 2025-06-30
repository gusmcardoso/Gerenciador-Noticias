<?php
// app/Models/Noticia.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Importe a classe Str

class Noticia extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'conteudo',
        'user_id',
        'image',
        'status',
        'slug', // Adicione slug ao fillable
    ];

    /**
     * Boot a nova instância do model.
     * Gera o slug automaticamente ao salvar, garantindo que seja único.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($noticia) {
            // Verifica se o título foi alterado ou se o slug está vazio
            if ($noticia->isDirty('titulo') || empty($noticia->slug)) {
                $slug = Str::slug($noticia->titulo);
                $originalSlug = $slug;
                $count = 1;

                // Loop para garantir que o slug seja único
                while (static::where('slug', $slug)->where('id', '!=', $noticia->id)->exists()) {
                    $slug = "{$originalSlug}-{$count}";
                    $count++;
                }
                $noticia->slug = $slug;
            }
        });
    }

    /**
     * Define a chave da rota para o model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
