<?php
// app/Http/Controllers/NoticiaController.php
namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    public function index(Request $request)
    {
        $query = Noticia::where('user_id', Auth::id())->with('category');

        if ($request->filled('search')) {
            $query->where('titulo', 'like', '%' . $request->search . '%');
        }

        $noticias = $query->latest()->paginate(10);

        return view('noticias.index', compact('noticias'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('noticias.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image');
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('noticias', 'public');
            $data['image'] = $path;
        }

        Noticia::create($data);

        return redirect()->route('noticias.index')->with('success', 'Notícia criada com sucesso!');
    }
public function show(Noticia $noticia)
    {
        // Regra de segurança: Garante que o usuário só pode ver sua própria notícia.
        if ($noticia->user_id !== Auth::id()) {
            abort(403, 'ACESSO NEGADO');
        }

        return view('noticias.show', compact('noticia'));
    }

    public function edit(Noticia $noticia)
    {
        // Regra de segurança: Garante que o usuário só pode editar sua própria notícia.
        // Se o usuário não for o dono da notícia, retorna um erro 403.
        if ($noticia->user_id !== Auth::id()) {
            abort(403, 'ACESSO NEGADO');
        }
        $categories = Category::all();
        return view('noticias.edit', compact('noticia', 'categories'));
    }

    public function update(Request $request, Noticia $noticia)
    {
        if ($noticia->user_id !== Auth::id()) {
            abort(403, 'ACESSO NEGADO');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Apaga a imagem antiga se existir
            if ($noticia->image && Storage::disk('public')->exists($noticia->image)) {
                Storage::disk('public')->delete($noticia->image);
            }
            $path = $request->file('image')->store('noticias', 'public');
            $data['image'] = $path;
        }

        $noticia->update($data);

        return redirect()->route('noticias.index')->with('success', 'Notícia atualizada com sucesso!');
    }

    public function destroy(Noticia $noticia)
    {
        if ($noticia->user_id !== Auth::id()) {
            abort(403, 'ACESSO NEGADO');
        }

        if ($noticia->image && Storage::disk('public')->exists($noticia->image)) {
            Storage::disk('public')->delete($noticia->image);
        }

        $noticia->delete();

        return redirect()->route('noticias.index')->with('success', 'Notícia excluída com sucesso!');
    }
}

