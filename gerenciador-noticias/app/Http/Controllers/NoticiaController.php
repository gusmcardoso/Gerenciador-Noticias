<?php
// app/Http/Controllers/NoticiaController.php
namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Noticia::where('user_id', Auth::id());

        // Implementação da Pesquisa
        if ($request->has('search') && $request->search != '') {
            $query->where('titulo', 'like', '%' . $request->search . '%');
        }

        $noticias = $query->latest()->paginate(10);

        return view('noticias.index', compact('noticias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('noticias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
        ]);

        $request->merge(['user_id' => Auth::id()]);
        Noticia::create($request->all());

        return redirect()->route('noticias.index')->with('success', 'Notícia criada com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Noticia $noticia)
    {
        // Garante que o usuário só pode editar sua própria notícia
        if ($noticia->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        return view('noticias.edit', compact('noticia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Noticia $noticia)
    {
        // Garante que o usuário só pode atualizar sua própria notícia
        if ($noticia->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
        ]);

        $noticia->update($request->all());

        return redirect()->route('noticias.index')->with('success', 'Notícia atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Noticia $noticia)
    {
        // Garante que o usuário só pode deletar sua própria notícia
        if ($noticia->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        $noticia->delete();

        return redirect()->route('noticias.index')->with('success', 'Notícia excluída com sucesso.');
    }
}
