<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroFilterRequest;
use App\Http\Requests\LivroRequest;
use App\Models\Assunto;
use App\Models\Autor;
use App\Models\Livro;
use App\Services\LivroService;


class LivroController extends Controller
{
    protected $livroService;

    public function __construct(LivroService $livroService)
    {
        $this->livroService = $livroService;
    }

    public function index(LivroFilterRequest $request)
    {
        // Pega a lista de livros
        $livros = $this->livroService->getLivrosPaginated($request);

        //carrega view de livros
        return view('livros.index', ['livros' => $livros]);
    }

    public function create()
    {
        // criar um novo livro
        $autores = Autor::all(); // busaca todos os autores para combo
        $assuntos = Assunto::all(); // busaca todos os assuntos para combo
        return view('livros.create', compact('assuntos', 'autores'));
    }

    public function store(LivroRequest $request)
    {
        //valida campos
        $data = $request->validated();
        //formata valor vindo do request
        $data['valor'] = $this->formatValor($request->valor);

        // Cria um novo objeto livro
        $this->livroService->createLivro($data);

        return redirect()->route('livro.index')->with('success', 'Livro cadastrado com sucesso!');
    }

    public function show($id)
    {
        // Buscar o livro e carregar as relações de Autor e Assunto
        $livro = Livro::with(['autores', 'assuntos'])->findOrFail($id);
        return view('livros.show', compact('livro'));
    }

    public function edit($id)
    {
        $livro      = Livro::with(['autores', 'assuntos'])->findOrFail($id);
        $autores    = Autor::all();
        $assuntos   = Assunto::all();
        return view('livros.edit', compact('livro', 'autores', 'assuntos'));
    }

    public function update(LivroRequest $request, $id)
    {
        $livro = Livro::findOrFail($id);
        //valida os campos
        $data = $request->validated();
        // Remove o prefixo e converte para formato float
        $data['valor'] = $this->formatValor($request->valor);

        // Atualiza o objeto livro
        $this->livroService->updateLivro($livro, $data);

        // Retorna para a lista de livros
        return redirect()->route('livro.index')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $livro = Livro::findOrFail($id);

        try {
            $this->livroService->deleteLivro($livro);
            return redirect()->route('livro.index')->with('success', 'Livro removido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('livro.index')->with('error', 'Erro ao remover o livro.');
        }
    }

    /**
     * Formata valaro do livro para manter no banco
     * @param string $valor
     * @return float
     */
    private function formatValor(string $valor): float
    {
        return (float) str_replace(['R$', '.', ',', ' '], ['', '', '.', ''], $valor);
    }
}
