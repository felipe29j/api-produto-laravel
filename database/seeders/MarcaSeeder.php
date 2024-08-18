<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marca;

class MarcaSeeder extends Seeder
{
    public function run()
    {
        $marcas = [
            ['nome' => 'Nike', 'fabricante' => 'Nike Inc.'],
            ['nome' => 'Adidas', 'fabricante' => 'Adidas AG'],
            ['nome' => 'Apple', 'fabricante' => 'Apple Inc.'],
            ['nome' => 'Samsung', 'fabricante' => 'Samsung Electronics'],
            ['nome' => 'Sony', 'fabricante' => 'Sony Corporation'],
            ['nome' => 'LG', 'fabricante' => 'LG Electronics'],
            ['nome' => 'Microsoft', 'fabricante' => 'Microsoft Corporation'],
            ['nome' => 'Dell', 'fabricante' => 'Dell Technologies'],
            ['nome' => 'HP', 'fabricante' => 'Hewlett-Packard'],
            ['nome' => 'Lenovo', 'fabricante' => 'Lenovo Group'],
        ];

        foreach ($marcas as $marca) {
            Marca::create($marca);
        }
    }
}

