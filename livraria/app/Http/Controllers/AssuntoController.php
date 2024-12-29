<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssuntoFilterRequest;
use App\Http\Requests\AssuntoRequest;
use App\Models\Assunto;
use App\Services\AssuntoService;

class AssuntoController extends Controller
{
    protected $assuntoService;

    public function __construct(AssuntoService $assuntoService)
    {
        $this->assuntoService = $assuntoService;
    }
    public function index(AssuntoFilterRequest $request)
    {
        // Pega a lista de assuntos
        $assuntos = $this->assuntoService->getAssuntosPaginated($request);

        //carrega view de assuntos
        return view('assuntos.index', ['assuntos' => $assuntos]);
    }

    public function create()
    {
        // criar um novo assunto
        return view('assuntos.create');
    }

    public function store(AssuntoRequest $request)
    {
        //valida campos
        $request->validated();

        // Cria um novo assunto
        Assunto::create([
            'descricao' => $request->descricao
        ]);

        // Retorna para a lista de assuntos
        return redirect()->route('assunto.index')->with('success', 'Assunto cadastrado com sucesso!');
    }

    public function show($id)
    {
        // detalha o assunto
        $assunto = Assunto::findOrFail($id);
        return view('assuntos.show', ['assunto' => $assunto]);
    }

    public function edit($id)
    {
        $assuntos = Assunto::findOrFail($id);
        return view('assuntos.edit', ['assunto' => $assuntos]);
    }

    public function update(AssuntoRequest $request, $id)
    {
        $request->validated();
        // Atualiza um assunto
        $assunto = Assunto::findOrFail($id);
        $assunto->update([
            'descricao' => $request->descricao
        ]);

        // Retorna para a lista de assuntos
        return redirect()->route('assunto.index')->with('success', 'Assunto alterado com sucesso!');
    }

    public function destroy($id)
    {
        // Deleta um assunto
        $assunto = Assunto::findOrFail($id);
        $assunto->delete();
        // retorna para a lista
        return redirect()->route('assunto.index')->with('success', 'Assunto removido com sucesso!');
    }
}
