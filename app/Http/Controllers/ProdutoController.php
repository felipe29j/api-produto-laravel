<?php
namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController; 

class ProdutoController extends Controller
{
    public function index()
    {        
        $produto = Produto::all();

        // Inclui as relações no retorno
        $produto->load('marca', 'cidade');
    
        return response()->json($produto);
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
