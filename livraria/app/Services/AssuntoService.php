<?php
namespace App\Services;

use App\Http\Requests\AssuntoFilterRequest;
use App\Models\Assunto;

class AssuntoService
{
    public function getAssuntosPaginated(AssuntoFilterRequest $request)
    {
        // Pega os filtros validados
        $request->validated();

        // Consulta os assuntos com base nos filtros
        $query = Assunto::query();

        // Obtém os filtros da requisição
        $filters = [
            'descricao' => $request->get('descricao', ''), // Valor padrão: string vazia
            'sort_by' => $request->get('sort_by', 'codAs'), // Valor padrão: 'livro_titulo'
            'sort_direction' => $request->get('sort_direction', 'desc') // Valor padrão: 'asc'
        ];

        $query->filterByDescricao($filters['descricao'])
            ->sortBy($filters['sort_by'], $filters['sort_direction'] ?? 'asc');

        return $query->paginate(10);
    }
}
