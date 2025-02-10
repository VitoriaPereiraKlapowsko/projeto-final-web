<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UnidadeDeMedidaController;
use App\Http\Controllers\BaixaController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;

// Página inicial
Route::get('/', function () {
    return view('welcome');
});

// Dashboard da autenticação
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rotas do Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUDs
    Route::resource('clientes', ClienteController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::resource('produtos', ProdutoController::class);
    Route::resource('unidades', UnidadeDeMedidaController::class);

    // Baixas (retiradas de estoque)
    Route::get('baixas/create', [BaixaController::class, 'create'])->name('baixas.create');
    Route::post('baixas', [BaixaController::class, 'store'])->name('baixas.store');

    // Relatórios
    Route::get('/retiradas-periodo', [RelatorioController::class, 'retiradasPorPeriodo'])->name('relatorios.retiradas_periodo');
    Route::get('/retiradas-cliente', [RelatorioController::class, 'retiradasPorCliente'])->name('relatorios.retiradas_por_cliente');
    Route::get('/produtos-sem-estoque', [RelatorioController::class, 'produtosSemEstoque'])->name('relatorios.produtos_sem_estoque');
    Route::get('/produtos-com-estoque', [RelatorioController::class, 'produtosComEstoque'])->name('relatorios.produtos_com_estoque');

    // Exportação de relatórios para PDF
    Route::get('/relatorios/retiradas-periodo/pdf', [RelatorioController::class, 'exportarRetiradasPeriodoPDF'])->name('relatorios.retiradas_periodo.pdf');
    Route::get('/relatorios/retiradas-cliente/pdf', [RelatorioController::class, 'exportarRetiradasPorClientePDF'])->name('relatorios.retiradas_por_cliente.pdf');
    Route::get('/relatorios/produtos-sem-estoque/pdf', [RelatorioController::class, 'exportarProdutosSemEstoquePDF'])->name('relatorios.produtos_sem_estoque.pdf');
    Route::get('/relatorios/produtos-com-estoque/pdf', [RelatorioController::class, 'exportarProdutosComEstoquePDF'])->name('relatorios.produtos_com_estoque.pdf');
});

// Carregando as rotas de autenticação 
require __DIR__.'/auth.php';

