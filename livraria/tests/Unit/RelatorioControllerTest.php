<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Livro;
use App\Services\RelatorioService;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioControllerTest extends TestCase
{
    protected $relatorioService;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock do RelatorioService se necessário
        $this->relatorioService = \Mockery::mock(RelatorioService::class);
        $this->app->instance(RelatorioService::class, $this->relatorioService);
    }

    /** @test */
    public function it_exports_excel()
    {
        // Mockando a exportação de Excel
        Excel::fake();

        // Enviando requisição para exportar Excel
        $response = $this->get(route('relatorio.export.excel'));

        // Verificando se o Excel foi gerado corretamente
        Excel::assertDownloaded('livros.xlsx');
    }
}
