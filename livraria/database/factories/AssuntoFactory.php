<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assunto>
 */
class AssuntoFactory extends Factory
{
    protected $model = \App\Models\Assunto::class;

    public function definition()
    {
        return [
            'descricao' => fake()->word,
        ];
    }
}
