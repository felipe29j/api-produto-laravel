<?php

namespace Database\Factories;

use App\Models\Produto;
use App\Models\Marca;
use App\Models\Cidade;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    protected $model = Produto::class;

    public function definition()
    {
        return [
            'nome_produto' => $this->faker->word,
            'valor_produto' => $this->faker->randomFloat(2, 10, 1000),
            'cod_marca' => Marca::factory(),
            'cod_cidade' => Cidade::factory(),
            'estoque' => $this->faker->numberBetween(1, 100),
        ];
    }
}


