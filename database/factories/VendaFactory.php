<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produto;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venda>
 */
class VendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        $produtos = Produto::inRandomOrder()->first();
        $comprador = User::where('id', '!=', $produtos->anunciante_id)->inRandomOrder()->first();
        $users = User::pluck('id');
        return [
            'produto_id' => $produtos->random(),
            'comprador_id' => $comprador->id,
            'vendedor_id' => $produtos->anunciante_id,
            'data_venda' => $this->faker->dateTimeBetween('2024-01-01 00:00:00', 'now'),
            'valor' => $produtos->preco,
        ];
    }
}
