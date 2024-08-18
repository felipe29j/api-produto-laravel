<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cidade;

class CidadeSeeder extends Seeder
{
    public function run()
    {
        $cidades = [
            'São Paulo',
            'Rio de Janeiro',
            'Belo Horizonte',
            'Salvador',
            'Brasília',
            'Fortaleza',
            'Curitiba',
            'Recife',
            'Manaus',
            'Porto Alegre',
        ];

        foreach ($cidades as $nome) {
            Cidade::create(['nome' => $nome]);
        }
    }
}

