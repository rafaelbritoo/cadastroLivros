<?php

namespace Database\Factories;

use App\Models\Autor;
use App\Models\Assunto;
use App\Models\Livro;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livro>
 */
class LivroFactory extends Factory
{
    protected $model = Livro::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence,
            'editora' => $this->faker->company,
            'edicao' => $this->faker->numberBetween(1, 10),
            'anoPublicacao' => $this->faker->year,
            'valor' => $this->faker->randomFloat(2, 20, 200),
            'autores' => Autor::factory()->count(2),  // Relacionamento com o Autor
            'assuntos' => Assunto::factory()->count(2),  // Relacionamento com o Assunto
        ];

    }
}
