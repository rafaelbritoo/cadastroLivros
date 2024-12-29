<?php
namespace App\Services;

use App\Http\Requests\AutorFilterRequest;
use App\Models\Autor;

class AutorService
{
    public function getAutoresPaginated(AutorFilterRequest $request)
    {
        // Pega os filtros validados
        $request->validated();

        // Consulta os assuntos com base nos filtros
        $query = Autor::query();

        // Obtém os filtros da requisição
        $filters = [
            'nome' => $request->get('nome', ''), // Valor padrão: string vazia
            'sort_by' => $request->get('sort_by', 'codAau'), // Valor padrão: 'livro_titulo'
            'sort_direction' => $request->get('sort_direction', 'desc') // Valor padrão: 'asc'
        ];

        $query->filterByNome($filters['nome'])
            ->sortBy($filters['sort_by'], $filters['sort_direction'] ?? 'asc');

        return $query->paginate(10);
    }
}
