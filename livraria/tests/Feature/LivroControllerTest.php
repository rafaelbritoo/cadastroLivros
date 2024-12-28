<?php

namespace Tests\Feature;

use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;
use App\Services\LivroService;
use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LivroControllerTest extends TestCase
{
    public function test_Store()
    {
        // Cria autores e assuntos usando as factories
        $autores = Autor::factory()->count(2)->create();
        $assuntos = Assunto::factory()->count(2)->create();

        // Dados de um livro fictício para testar
        $livroData = [
            'titulo' => 'Livro Teste',
            'editora' => 'Editora Teste',
            'edicao' => 1,
            'anoPublicacao' => '2024',
            'valor' => 50,
            'codAu' => $autores->pluck('codAu')->first(), // ID de autores
            'codAs' => $assuntos->pluck('codAs')->first()  // ID de assuntos
        ];

        // Mock do LivroService
        $livroServiceMock = Mockery::mock(LivroService::class);

        // Mockando a criação do livro e retornando um objeto Livro simulado
        $livroMock = Mockery::mock(Livro::class);
        $livroMock->shouldReceive('create')->with($livroData)->andReturn($livroMock);

        $livroServiceMock->shouldReceive('createLivro')->with($livroData)->andReturn($livroMock);

        $this->app->instance(LivroService::class, $livroServiceMock);

        // Realiza a requisição POST
        $response = $this->post(route('store-livro'), $livroData);

        // Verifica se foi redirecionado corretamente
        $response->assertRedirect(route('livro.index'));
        $response->assertSessionHas('success', 'Livro cadastrado com sucesso!');
    }
}
