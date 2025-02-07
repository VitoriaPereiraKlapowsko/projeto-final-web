<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UnidadeDeMedidaController;
use App\Http\Controllers\BaixaController;
use App\Http\Controllers\RelatorioController;

Route::resource('clientes', ClienteController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('produtos', ProdutoController::class);
Route::get('/', [ClienteController::class, 'index']);
Route::resource('unidades', UnidadeDeMedidaController::class);
Route::get('baixas/create', [BaixaController::class, 'create'])->name('baixas.create');
Route::post('baixas', [BaixaController::class, 'store'])->name('baixas.store');

Route::get('/retiradas-periodo', [RelatorioController::class, 'retiradasPorPeriodo'])->name('relatorios.retiradas_periodo');
Route::get('/retiradas-cliente', [RelatorioController::class, 'retiradasPorCliente'])->name('relatorios.retiradas_por_cliente');
Route::get('/produtos-sem-estoque', [RelatorioController::class, 'produtosSemEstoque'])->name('relatorios.produtos_sem_estoque');
Route::get('/produtos-com-estoque', [RelatorioController::class, 'produtosComEstoque'])->name('relatorios.produtos_com_estoque');

Route::get('/relatorios/retiradas-periodo/pdf', [RelatorioController::class, 'exportarRetiradasPeriodoPDF'])->name('relatorios.retiradas_periodo.pdf');
Route::get('/relatorios/retiradas-cliente/pdf', [RelatorioController::class, 'exportarRetiradasPorClientePDF'])->name('relatorios.retiradas_por_cliente.pdf');
Route::get('/relatorios/produtos-sem-estoque/pdf', [RelatorioController::class, 'exportarProdutosSemEstoquePDF'])->name('relatorios.produtos_sem_estoque.pdf');
Route::get('/relatorios/produtos-com-estoque/pdf', [RelatorioController::class, 'exportarProdutosComEstoquePDF'])->name('relatorios.produtos_com_estoque.pdf');

