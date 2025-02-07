<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Baixa;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioController extends Controller
{
    public function retiradasPorPeriodo(Request $request)
{
    $periodo = $request->input('periodo', 'diario');

    $query = Baixa::with('produto.unidadeDeMedida', 'produto.categoria', 'cliente');

    if ($periodo == 'diario') {
        $query->selectRaw('DATE(data_hora) as periodo, produto_id, cliente_id, SUM(quantidade) as total, SUM(valor_total) as valor_total, MAX(data_hora) as data_retirada')
              ->groupBy('periodo', 'produto_id', 'cliente_id');
    } elseif ($periodo == 'semanal') {
        $query->selectRaw('YEARWEEK(data_hora) as periodo, produto_id, cliente_id, SUM(quantidade) as total, SUM(valor_total) as valor_total, MAX(data_hora) as data_retirada')
              ->groupBy('periodo', 'produto_id', 'cliente_id');
    } elseif ($periodo == 'mensal') {
        $query->selectRaw('DATE_FORMAT(data_hora, "%Y-%m") as periodo, produto_id, cliente_id, SUM(quantidade) as total, SUM(valor_total) as valor_total, MAX(data_hora) as data_retirada')
              ->groupBy('periodo', 'produto_id', 'cliente_id');
    }

    $retiradas = $query->get();

    return view('relatorios.pdf.retiradas_por_periodo', compact('retiradas', 'periodo'));
}

public function retiradasPorCliente()
{
    $retiradas = Baixa::with('produto.unidadeDeMedida', 'produto.categoria', 'cliente')
        ->selectRaw('cliente_id, produto_id, SUM(quantidade) as total, SUM(valor_total) as valor_total, MAX(data_hora) as data_retirada')
        ->groupBy('cliente_id', 'produto_id')
        ->get();

    return view('relatorios.retiradas_por_cliente', compact('retiradas'));
}

public function produtosSemEstoque()
{
    $produtos = Produto::where('estoque', 0)
        ->selectRaw('id, nome, unidade_de_medida_id, categoria_id, updated_at as data_estoque_zero')
        ->with('unidadeDeMedida', 'categoria')
        ->get();
    
    return view('relatorios.produtos_sem_estoque', compact('produtos'));
}

public function produtosComEstoque()
{
    $produtos = Produto::where('estoque', '>', 0)
        ->selectRaw('id, nome, unidade_de_medida_id, categoria_id, quantidade, (quantidade / estoque) * 100 as percentual')
        ->with('unidadeDeMedida', 'categoria')
        ->get();

    return view('relatorios.produtos_com_estoque', compact('produtos'));
}

    public function exportarRetiradasPeriodoPDF(Request $request)
    {
        $periodo = $request->input('periodo', 'diario');
        $retiradas = Baixa::with('produto', 'cliente')->get();

        $pdf = Pdf::loadView('relatorios.pdf.retiradas_por_periodo', compact('retiradas', 'periodo'));

        return $pdf->download('relatorio_retiradas_'.$periodo.'.pdf');
    }
}
