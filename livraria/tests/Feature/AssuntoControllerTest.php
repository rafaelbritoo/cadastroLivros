<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Assunto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssuntoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_assuntos_index_displays_data(): void
    {
        // Cria 5 registros fictícios
        Assunto::factory()->count(5)->create();

        // Faz uma requisição para o endpoint
        $response = $this->get(route('assunto.index'));

        // Verifica se os dados aparecem na resposta
        $response->assertStatus(200);
        $response->assertSee(Assunto::first()->descricao);
    }
}
