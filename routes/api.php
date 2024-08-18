<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CidadeController;

Route::get('produtos', [ProdutoController::class, 'index']);
Route::get('produtos/{id}', [ProdutoController::class, 'show']);
Route::post('produtos', [ProdutoController::class, 'store']);
Route::put('produtos/{id}', [ProdutoController::class, 'update']);
Route::delete('produtos/{id}', [ProdutoController::class, 'destroy']);

Route::get('cidades', [CidadeController::class, 'index']);
