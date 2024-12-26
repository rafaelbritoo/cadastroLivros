<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Models\Assunto;
use App\Models\Autor;
use App\Models\Livro;
use App\Models\LivroAssunto;
use App\Models\LivroAutor;
use Illuminate\Support\Facades\DB;


class LivroController extends Controller
{
    public function __construct()
    {
        $objAutor   = new Autor();
        $objAssunto = new Assunto();

        $this->objAutor   = $objAutor;
        $this->objAssunto = $objAssunto;
    }

    public function index()
    {
        // Pega a lista de livros
        $livros = Livro::orderByDesc('codl')->get();

        //carrega view de livros
        return view('livros.index', ['livros' => $livros]);
    }

    public function create()
    {
        // criar um novo livro
        $autores = $this->objAutor->all();
        $assuntos = $this->objAssunto->all();
        return view('livros.create', compact('assuntos', 'autores'));
    }

    public function store(LivroRequest $request)
    {
        // Remove o prefixo e converte para formato float
        $valor = str_replace(['R$', '.', ',', ' '], ['', '', '.',''], $request->valor);

        //valida campos
        $request->validated();

        // Cria um novo livro
        $livro = Livro::create([
            'titulo'        => $request->titulo,
            'editora'       => $request->editora,
            'edicao'        => $request->edicao,
            'valor'         => $valor,
            'anoPublicacao' => $request->anoPublicacao
        ]);

        LivroAutor::create([
            'livro_cod'   => $livro->codl,
            'autor_codAu' => $request->codAu
        ]);

        LivroAssunto::create([
            'livro_cod'   => $livro->codl,
            'assunto_codAs' => $request->codAs
        ]);

        // Retorna para a lista de livros
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
        $autores    = $this->objAutor->all();
        $assuntos   = $this->objAssunto->all();
        return view('livros.edit', compact('livro', 'autores', 'assuntos'));
    }

    public function update(LivroRequest $request, $id)
    {
        // Remove o prefixo e converte para formato float
        $valor = str_replace(['R$', '.', ',', ' '], ['', '', '.',''], $request->valor);

        $request->validated();
        // Atualiza um livro
        $livro = Livro::findOrFail($id);

        $livro->update([
            'titulo'        => $request->titulo,
            'editora'       => $request->editora,
            'edicao'        => $request->edicao,
            'valor'         => $valor,
            'anoPublicacao' => $request->anoPublicacao
        ]);

        if ($request->codAu) {
            // Atualiza ou insere o registro relacionado de Livro_Autor
            LivroAutor::updateOrInsert(
                ['livro_cod' => $id], // Condição para verificar se o registro existe
                ['autor_codAu' => $request->codAu] // Dados a serem atualizados ou inseridos
            );
        }

        if ($request->codAs) {
            // Atualiza ou insere o registro relacionado de Livro_Assunto
            LivroAssunto::updateOrInsert(
                ['livro_cod' => $id], // Condição para verificar se o registro existe
                ['assunto_codAs' => $request->codAs] // Dados a serem atualizados ou inseridos
            );
        }

        // Retorna para a lista de livros
        return redirect()->route('livro.index')->with('success', 'Livro alterado com sucesso!');
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            // Obter o livro pelo ID
            $livro = Livro::findOrFail($id);

            // Excluir os registros nas tabelas relacionadas
            LivroAssunto::where('livro_cod', $livro->codl)->delete();
            LivroAutor::where('livro_cod', $livro->codl)->delete();

            // Excluir o livro
            $livro->delete();

            DB::commit(); // Confirmar as alterações no banco
            return redirect()->route('livro.index')->with('success', 'Livro removido com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack(); // Reverter todas as alterações se ocorrer um erro
            return redirect()->route('livro.index')->with('error', 'Erro ao remover o livro.');
        }
    }
}
