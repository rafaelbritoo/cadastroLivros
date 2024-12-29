<?php
namespace App\Services;

use App\Http\Requests\LivroFilterRequest;
use App\Models\Livro;
use App\Models\LivroAutor;
use App\Models\LivroAssunto;
use Illuminate\Support\Facades\DB;

class LivroService
{
    public function createLivro(array $data): Livro
    {
        return DB::transaction(function () use ($data) {
            $livro = Livro::create($data);

            if (!empty($data['codAu'])) {
                LivroAutor::create([
                    'livro_codl' => $livro->codl,
                    'autor_codAu' => $data['codAu'],
                ]);
            }

            if (!empty($data['codAs'])) {
                LivroAssunto::create([
                    'livro_codl' => $livro->codl,
                    'assunto_codAs' => $data['codAs'],
                ]);
            }

            return $livro;
        });
    }

    public function updateLivro(Livro $livro, array $data): Livro
    {
        return DB::transaction(function () use ($livro, $data) {
            $livro->update($data);

            LivroAutor::updateOrInsert(
                ['livro_codl' => $livro->codl],
                ['autor_codAu' => $data['codAu'] ?? null]
            );

            LivroAssunto::updateOrInsert(
                ['livro_codl' => $livro->codl],
                ['assunto_codAs' => $data['codAs'] ?? null]
            );

            return $livro;
        });
    }

    public function deleteLivro(Livro $livro): void
    {
        DB::transaction(function () use ($livro) {
            LivroAssunto::where('livro_codl', $livro->codl)->delete();
            LivroAutor::where('livro_codl', $livro->codl)->delete();
            $livro->delete();
        });
    }

    /**
     * Construir a consulta para os livros com base nos filtros.
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getLivrosPaginated(LivroFilterRequest $request)
    {
        // Valida os campos do Form Request
        $request->validated();

        // Obtém os filtros da requisição
        $filters = [
            'titulo' => $request->get('titulo', ''),
            'editora' => $request->get('editora', ''),
            'edicao' => $request->get('edicao', ''),
            'anoPublicacao' => $request->get('anoPublicacao', ''),
            'sort_by' => $request->get('sort_by', 'codal'),
            'sort_direction' => $request->get('sort_direction', 'asc')
        ];
        $query = Livro::query();

        $query->filterByTitulo($filters['titulo'])
            ->filterByEditora($filters['editora'])
            ->filterByEdicao($filters['edicao'])
            ->filterByAnoPublicacao($filters['anoPublicacao'])
            ->sortBy($filters['sort_by'], $filters['sort_direction'] ?? 'asc');

        return $query->paginate(10);
    }
}
