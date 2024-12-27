<?php

namespace App\Exports;

use App\Models\Livro;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class LivrosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Coletando os livros (pode ser filtrado conforme necessário)
        $livros = DB::table('vw_catalogo_livros')->get();
        return $livros;
    }

    /**
     * Cabeçalhos da exportação
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Código',
            'Título',
            'Editora',
            'Edição',
            'Ano de Publicação',
            'Autor',
            'Assunto',
            'Valor'
        ];
    }
}
