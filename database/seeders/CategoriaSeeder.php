<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            'Celulares',
            'Computadores',
            'Periféricos',
            'Notebooks',
            'Tablets',
        ];

        foreach ($categorias as $categoria){
            Categoria::create(['nome' => $categoria]);
        }
    }
}
