<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\MarcaController;

Route::get('api/produtos', [ProdutoController::class, 'index']);
Route::get('api/produtos/{id}', [ProdutoController::class, 'show']);
Route::post('api/produtos', [ProdutoController::class, 'store']);
Route::put('api/produtos/{id}', [ProdutoController::class, 'update']);
Route::delete('api/produtos/{id}', [ProdutoController::class, 'destroy']);

Route::get('api/cidades', [CidadeController::class, 'index']);
Route::get('api/marcas', [MarcaController::class, 'index']);


Route::get('/', function () {
    return view('index');
});
