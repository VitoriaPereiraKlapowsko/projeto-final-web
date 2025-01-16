<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UnidadeDeMedidaController;

Route::resource('clientes', ClienteController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('produtos', ProdutoController::class);
Route::get('/', [ClienteController::class, 'index']);
Route::resource('unidades', UnidadeDeMedidaController::class);