<?php
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
        $query = Noticia::where('user_id', Auth::id())->with('categories');

        if ($request->filled('search')) {
            $query->where('titulo', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // ATUALIZADO: Adiciona filtro para múltiplas categorias
        if ($request->filled('category_ids')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->whereIn('categories.id', $request->category_ids);
            });
        }

        $noticias = $query->latest()->paginate(5);
        $categories = Category::all(); // Pega todas as categorias para o dropdown

        return view('noticias.index', compact('noticias', 'categories'));
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
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except(['image', 'categories']);
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('noticias', 'public');
            $data['image'] = $path;
        }

        $noticia = Noticia::create($data);
        $noticia->categories()->attach($request->categories);

        return redirect()->route('noticias.index')->with('success', 'Notícia criada com sucesso!');
    }

    public function show(Noticia $noticia)
    {
        if ($noticia->user_id !== Auth::id()) {
            abort(403, 'ACESSO NEGADO');
        }
        return view('noticias.show', compact('noticia'));
    }

    public function edit(Noticia $noticia)
    {
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
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except(['image', 'categories']);

        if ($request->hasFile('image')) {
            if ($noticia->image && Storage::disk('public')->exists($noticia->image)) {
                Storage::disk('public')->delete($noticia->image);
            }
            $path = $request->file('image')->store('noticias', 'public');
            $data['image'] = $path;
        }

        $noticia->update($data);
        $noticia->categories()->sync($request->categories);

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
