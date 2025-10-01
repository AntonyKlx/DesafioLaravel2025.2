<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'logradouro' => fake()->streetName(),
            'cep' => fake()->numerify('########'),
            'bairro' => fake()->citySuffix(),
            'cidade' => fake()->city(),
            'estado' => fake()->stateAbbr(),
            'telefone' => fake()->numerify('###########'),
            'data_de_nascimento' => fake()->date('Y-m-d', '2005-01-01'),
            'cpf' => fake()->numerify('###########'),
            'foto' => 'images/PerfilDefault.png',
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
