<?php

namespace Database\Factories;

use App\Models\Cidade;
use Illuminate\Database\Eloquent\Factories\Factory;

class CidadeFactory extends Factory
{
    protected $model = Cidade::class;

    public function definition()
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1, 1000),
            'nome' => $this->faker->city,
        ];
    }
}


