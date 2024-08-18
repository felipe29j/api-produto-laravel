<?php

namespace Database\Factories;

use App\Models\Marca;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarcaFactory extends Factory
{
    protected $model = Marca::class;

    public function definition()
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1, 1000),
            'nome' => $this->faker->company,
            'fabricante' => $this->faker->company,
        ];
    }
}


