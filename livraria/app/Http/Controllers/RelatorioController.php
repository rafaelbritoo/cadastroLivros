<?php
namespace App\Http\Controllers;

use App\Http\Requests\RelatorioRequest;
use App\Services\RelatorioService;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LivrosExport;

class RelatorioController extends Controller
{
    protected $relatorioService;

    public function __construct(RelatorioService $relatorioService)
    {
        $this->relatorioService = $relatorioService;
    }

    public function index(RelatorioRequest $request)
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

        // Obtém os livros paginados usando o serviço
        $livros = $this->relatorioService->getLivrosPaginated($filters);

        // Carrega a view com os livros paginados
        return view('relatorios.index', compact('livros'));
    }

    /**
     * Exporta os livros para PDF
     */
    public function exportPdf()
    {
        // Coletando os livros (pode ser filtrado conforme necessário)
        $livros = DB::table('vw_catalogo_livros')->get();

        // Gerando o PDF
        $pdf = PDF::loadView('relatorios.pdf', compact('livros'));

        // Retornando o PDF para download
        return $pdf->download('livros.pdf');
    }

    /**
     * Exporta os livros para Excel
     */
    public function exportExcel()
    {
        return Excel::download(new LivrosExport, 'livros.xlsx');
    }
}

