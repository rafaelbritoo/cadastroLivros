<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorFilterRequest;
use App\Http\Requests\AutorRequest;
use App\Models\Autor;
use App\Services\AutorService;

class AutorController extends Controller
{
    protected $autorService;

    public function __construct(AutorService $autorService)
    {
        $this->autorService = $autorService;
    }
    public function index(AutorFilterRequest $request)
    {
        // Pega a lista de autores
        $autores = $this->autorService->getAutoresPaginated($request);

        //carrega view de autores
        return view('autores.index', ['autores' => $autores]);
    }

    public function create()
    {
        // criar um novo autor
        return view('autores.create');
    }

    public function store(AutorRequest $request)
    {
        //valida campos
        $request->validated();

        // Cria um novo autor
        Autor::create([
            'nome' => $request->nome
        ]);

        // Retorna para a lista de autores
        return redirect()->route('autor.index')->with('success', 'Autor cadastrado com sucesso!');
    }

    public function show($id)
    {
        $autor = Autor::findOrFail($id);
        return view('autores.show', ['autor' => $autor]);
    }

    public function edit($id)
    {
        $autor = Autor::findOrFail($id);
        return view('autores.edit', ['autor' => $autor]);
    }

    public function update(AutorRequest $request, $id)
    {
        $request->validated();
        // Atualiza um autor
        $autor = Autor::findOrFail($id);
        $autor->update([
            'nome' => $request->nome
        ]);

        // Retorna para a lista de autores
        return redirect()->route('autor.index')->with('success', 'Autor alterado com sucesso!');
    }

    public function destroy($id)
    {
        // Deleta um autor
        $autor = Autor::findOrFail($id);
        $autor->delete();
        // retorna para a lista
        return redirect()->route('autor.index')->with('success', 'Autor removido com sucesso!');
    }
}
