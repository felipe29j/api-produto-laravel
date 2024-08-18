<?php
namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController; 

class ProdutoController extends Controller
{
   // app/Http/Controllers/ProdutoController.php

   public function index(Request $request)
   {
       // Inicia a query para buscar produtos
       $query = Produto::query();
   
       // Adiciona filtros se eles estiverem presentes na requisição
       if ($request->filled('valor_min') && is_numeric($request->input('valor_min'))) {
           $query->where('valor_produto', '>=', $request->input('valor_min'));
       }
   
       if ($request->filled('valor_max') && is_numeric($request->input('valor_max'))) {
           $query->where('valor_produto', '<=', $request->input('valor_max'));
       }
   
       if ($request->filled('cidade_id') && is_numeric($request->input('cidade_id'))) {
           $query->where('cod_cidade', $request->input('cidade_id'));
       }
   
       // Executa a query e inclui as relações de marca e cidade
       $produtos = $query->with('marca', 'cidade')->get();
   
       // Retorna a resposta JSON com os produtos
       return response()->json($produtos);
   }

    public function show($id)
    {
        return Produto::findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_produto' => 'required|unique:produtos',
            'valor_produto' => 'required|numeric',
            'cod_marca' => 'required', 
            'estoque' => 'required|numeric',
            'cod_cidade' => 'required', 
        ]);


        $produto = Produto::create($request->all());

        // Inclui as relações no retorno
        $produto->load('marca', 'cidade');
    
        return response()->json($produto);
        }

    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $request->validate([
            'nome_produto' => 'required|unique:produtos,nome_produto,' . $produto->id,
            'valor_produto' => 'required|numeric',
            'cod_marca' => 'required',
            'estoque' => 'required|numeric',
            'cod_cidade' => 'required',
        ]);

        $produto->update($request->all());
        return $produto;
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);


        $produto->delete();
        return response()->json(null, 204);
    }
}
