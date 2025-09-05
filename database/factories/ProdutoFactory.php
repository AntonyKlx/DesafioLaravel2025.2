<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categorias = Categoria::pluck('id_categoria');
        $users = User::pluck('id');
        return [
            'foto' => 'https://picsum.photos/seed/' . $this->faker->unique()->numberBetween(1, 1000) . '/400/400',
            'nome' => $this->faker->word(),
            'preco' => $this->faker->randomFloat(2, 10, 1000),
            'descricao' => $this->faker->sentence(),
            'quantidade' => $this->faker->numberBetween(1, 50),
            'categoria_id' => $categorias->random(),
            'anunciante_id' => $users->random(),
        ];
    }
}
