<?php
namespace App\Services;

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
}
