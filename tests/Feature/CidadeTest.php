<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Cidade;

class CidadeTest extends TestCase
{
    use RefreshDatabase;

    public function testCanListCidades()
    {        
        $response = $this->get('api/cidades');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'cod_cidade',
                'nome_cidade',
                'created_at',
                'updated_at',
            ]
        ]);
    }
}

