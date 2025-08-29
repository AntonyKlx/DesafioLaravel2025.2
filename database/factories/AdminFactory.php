<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'senha' => bcrypt('password'),
            'logradouro' => fake()->streetName(),
            'cep' => fake()->numerify('########'),
            'bairro' => fake()->citySuffix(),
            'cidade' => fake()->city(),
            'estado' => fake()->stateAbbr(),
            'telefone' => fake()->numerify('###########'),
            'data_de_nascimento' => fake()->date('Y-m-d', '2005-01-01'),
            'cpf' => fake()->numerify('###########'),
            'foto' => 'default.png',
        ];
    }
}
