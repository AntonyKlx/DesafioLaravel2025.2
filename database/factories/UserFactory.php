<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

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
            'cep' => fake()->numerify('########'),
            'logradouro' => fake()->streetName(),
            'bairro' => fake()->citySuffix(),
            'cidade' => fake()->city(),
            'estado' => fake()->stateAbbr(),
            'complemento' => fake()->secondaryAddress(),
            'telefone' => fake()->numerify('###########'),
            'data_de_nascimento' => fake()->date('Y-m-d', '2005-01-01'),
            'cpf' => fake()->numerify('###########'),
            'saldo' => fake()->randomFloat(2, 0, 1000),
            'foto' => 'default.png',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
