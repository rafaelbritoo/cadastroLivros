<?php

namespace Tests\Feature;

use App\Models\Autor;
use Tests\TestCase;

class AutorControllerTest extends TestCase
{
    public function test_assuntos_index_displays_data(): void
    {
        // Cria 5 registros fictícios
        Autor::factory()->count(5)->create();

        // Faz uma requisição para o endpoint
        $response = $this->get(route('assunto.index'));

        // Verifica se os dados aparecem na resposta
        $response->assertStatus(200);
        $response->assertSee(Autor::first()->descricao);
    }
}
