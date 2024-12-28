<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Assunto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssuntoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_list_of_assuntos()
    {
        // Arrange: Cria alguns registros na base de dados
        Assunto::factory()->count(3)->create();

        // Act: Faz a requisição GET para a rota index
        $response = $this->get(route('assunto.index'));

        // Assert: Verifica se a resposta está correta e contém os dados
        $response->assertStatus(200);
        $response->assertViewIs('assuntos.index');
        $response->assertViewHas('assuntos');
    }
}
