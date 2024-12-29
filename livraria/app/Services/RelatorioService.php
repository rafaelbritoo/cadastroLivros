<?php
namespace App\Services;

use App\Http\Requests\RelatorioRequest;
use App\Models\Relatorio;

class RelatorioService
{
    /**
     * Construir a consulta para os livros com base nos filtros.
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getLivrosPaginated(array $filters)
    {
        $query = Relatorio::query();

        $query->filterByTitulo($filters['titulo'])
            ->filterByAutor($filters['autor'])
            ->filterByAssunto($filters['assunto'])
            ->sortBy($filters['sort_by'], $filters['sort_direction'] ?? 'asc');

        return $query->paginate(10);
    }

    public function getLivros(RelatorioRequest $request)
    {
        // Valida os campos do Form Request
        $request->validated();

        // Obtém os filtros da requisição
        $filters = [
            'titulo' => $request->get('titulo', ''),  // Valor padrão: string vazia
            'autor' => $request->get('autor', ''),    // Valor padrão: string vazia
            'assunto' => $request->get('assunto', ''), // Valor padrão: string vazia
            'sort_by' => $request->get('sort_by', 'livro_titulo'), // Valor padrão: 'livro_titulo'
            'sort_direction' => $request->get('sort_direction', 'asc') // Valor padrão: 'asc'
        ];

        return $this->getLivrosPaginated($filters);
    }
}
