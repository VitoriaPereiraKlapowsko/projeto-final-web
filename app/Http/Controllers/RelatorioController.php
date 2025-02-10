<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Baixa;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioController extends Controller
{ // Método que exibe o relatório de retiradas agrupadas por período (diário, semanal, mensal).
    public function retiradasPorPeriodo(Request $request)
{
    $periodo = $request->input('periodo', 'diario');
// Buscando as baixas com as relações dos produtos, unidades e clientes.
    $query = Baixa::with('produto.unidadeDeMedida', 'produto.categoria', 'cliente');
 // Condições que definem a forma de agrupamento com base no período escolhido, que não deu tão certo assim...
    if ($periodo == 'diario') {
        // Para o período diário, agrupa as retiradas por data (sem considerar hora), produto e cliente
    // Utiliza a função DATE para extrair apenas a data da coluna 'data_hora', ignorando a hora.
        $query->selectRaw('DATE(data_hora) as periodo, produto_id, cliente_id, SUM(quantidade) as total, SUM(valor_total) as valor_total, MAX(data_hora) as data_retirada')
              ->groupBy('periodo', 'produto_id', 'cliente_id');
    } elseif ($periodo == 'semanal') {
         // Para o período semanal, utiliza YEARWEEK para agrupar as retiradas por ano e semana
    // YEARWEEK retorna um valor único representando o ano e a semana 
        $query->selectRaw('YEARWEEK(data_hora) as periodo, produto_id, cliente_id, SUM(quantidade) as total, SUM(valor_total) as valor_total, MAX(data_hora) as data_retirada')
              ->groupBy('periodo', 'produto_id', 'cliente_id');
    } elseif ($periodo == 'mensal') {
        // Para o período mensal, utiliza DATE_FORMAT para extrair o ano e mês da coluna 'data_hora'
    // O formato "%Y-%m" retorna o ano e mês
        $query->selectRaw('DATE_FORMAT(data_hora, "%Y-%m") as periodo, produto_id, cliente_id, SUM(quantidade) as total, SUM(valor_total) as valor_total, MAX(data_hora) as data_retirada')
              ->groupBy('periodo', 'produto_id', 'cliente_id');
    }

    $retiradas = $query->get();

    return view('relatorios.pdf.retiradas_por_periodo', compact('retiradas', 'periodo'));
}

public function exportarRetiradasPeriodoPDF(Request $request)
{
    $periodo = $request->input('periodo', 'diario');
     // Recupera as baixas sem agrupamento para gerar o relatório
    $retiradas = Baixa::with('produto', 'cliente')->get();
// Gera o PDF usando a view 'relatorios.pdf.retiradas_por_periodo'
    $pdf = Pdf::loadView('relatorios.pdf.retiradas_por_periodo', compact('retiradas', 'periodo'));
 // Faz o download do PDF gerado com o nome mais adequado
    return $pdf->download('relatorio_retiradas_'.$periodo.'.pdf');
}

public function retiradasPorCliente()
{ // Consulta as retiradas agrupadas por cliente e produto, somando quantidade e valor total
    $retiradas = Baixa::with('produto.unidadeDeMedida', 'produto.categoria', 'cliente')
        ->selectRaw('cliente_id, produto_id, SUM(quantidade) as total, SUM(valor_total) as valor_total, MAX(data_hora) as data_retirada')
        ->groupBy('cliente_id', 'produto_id')
        ->get();

    return view('relatorios.pdf.retiradas_por_cliente', compact('retiradas'));
}

public function exportarRetiradasPorClientePDF()
    {
        $retiradas = Baixa::with('produto.unidadeDeMedida', 'produto.categoria', 'cliente')
            ->selectRaw('cliente_id, produto_id, SUM(quantidade) as total, SUM(valor_total) as valor_total, MAX(data_hora) as data_retirada')
            ->groupBy('cliente_id', 'produto_id')
            ->get();

        $pdf = Pdf::loadView('relatorios.pdf.retiradas_por_cliente', compact('retiradas'));

        return $pdf->download('relatorio_retiradas_por_cliente.pdf');
    }

public function produtosSemEstoque()
{// Consulta os produtos com estoque igual a zero
    $produtos = Produto::where('estoque', 0)
        ->selectRaw('id, nome, unidade_de_medida_id, categoria_id, updated_at as data_estoque_zero')
        ->with('unidadeDeMedida', 'categoria')
        ->get();
    
    return view('relatorios.pdf.produtos_sem_estoque', compact('produtos'));
}

public function exportarProdutosSemEstoquePDF()
{
    $produtos = Produto::where('estoque', 0)
        ->selectRaw('id, nome, unidade_de_medida_id, categoria_id, updated_at as data_estoque_zero')
        ->with('unidadeDeMedida', 'categoria')
        ->get();

    $pdf = Pdf::loadView('relatorios.pdf.produtos_sem_estoque', compact('produtos'));

    return $pdf->download('relatorio_produtos_sem_estoque.pdf');
}

public function produtosComEstoque()
{
    $produtos = Produto::where('estoque', '>', 0)
        ->selectRaw('id, nome, unidade_de_medida_id, categoria_id, quantidade, (quantidade / estoque) * 100 as percentual')
        ->with('unidadeDeMedida', 'categoria')
        ->get();

    return view('relatorios.pdf.produtos_com_estoque', compact('produtos'));
}

public function exportarProdutosComEstoquePDF()
{ // Consulta os produtos com estoque maior que zero e calcula o percentual de estoque restante
    $produtos = Produto::where('estoque', '>', 0)
        ->selectRaw('id, nome, unidade_de_medida_id, categoria_id, quantidade, (quantidade / estoque) * 100 as percentual')
        ->with('unidadeDeMedida', 'categoria')
        ->get();

    $pdf = Pdf::loadView('relatorios.pdf.produtos_com_estoque', compact('produtos'));

    return $pdf->download('relatorio_produtos_com_estoque.pdf');
}

}
