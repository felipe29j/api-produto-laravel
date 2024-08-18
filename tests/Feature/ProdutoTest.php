<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Produto;
use App\Models\Marca;
use App\Models\Cidade;

class ProdutoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function testCanListProdutos()
    {

        $response = $this->get('/api/produtos');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'cod_produto',
                'nome_produto',
                'valor_produto',
                'cod_marca',
                'estoque',
                'cod_cidade',
                'created_at',
                'updated_at',
            ]
        ]);
    }

    public function testCanCreateProduto()
    {
        $marca = Marca::first();
        $cidade = Cidade::first();

        $this->assertNotNull($marca, 'Nenhuma marca encontrada');
        $this->assertNotNull($cidade, 'Nenhuma cidade encontrada');

        $response = $this->post('/api/produtos', [
            'nome_produto' => 'Produto Teste',
            'valor_produto' => 99.99,
            'cod_marca' => $marca->id,
            'estoque' => 10,
            'cod_cidade' => $cidade->id, 
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('produtos', [
            'nome_produto' => 'Produto Teste',
            'valor_produto' => 99.99,
            'estoque' => 10,
            'cod_marca' => $marca->id, 
            'cod_cidade' => $cidade->id, 
        ]);
    }


    public function testCanUpdateProduto()
    {
        $marca = Marca::factory()->create();
        $cidade = Cidade::factory()->create();

        $produto = Produto::factory()->create([
            'cod_marca' => $marca->id,
            'cod_cidade' => $cidade->id,
        ]);

        $response = $this->put("/api/produtos/{$produto->id}", [
            'nome_produto' => 'Produto Atualizado',
            'valor_produto' => 89.99,
            'cod_marca' => $produto->cod_marca, 
            'estoque' => 15,
            'cod_cidade' => $produto->cod_cidade, 
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('produtos', [
            'id' => $produto->id,
            'nome_produto' => 'Produto Atualizado',
            'valor_produto' => 89.99,
            'estoque' => 15,
        ]);
    }



    public function testCanDeleteProduto()
    {
        $produto = Produto::factory()->create(['estoque' => 0]);

        $response = $this->delete("/api/produtos/{$produto->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('produtos', [
            'id' => $produto->id,
        ]);
    }

    public function testCannotDeleteProdutoWithEstoque()
    {
        $produto = Produto::factory()->create(['estoque' => 10]);

        $response = $this->delete("/api/produtos/{$produto->id}");

        $response->assertStatus(400); 
        $this->assertDatabaseHas('produtos', [
            'id' => $produto->id,
        ]);
    }
}
