<?php

namespace App\Http\Controllers;

use App\Models\Baixa;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BaixaController extends Controller
{
    public function create()
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        return view('baixas.create', compact('clientes', 'produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        $produto = Produto::findOrFail($request->produto_id);

        if ($request->quantidade > $produto->estoque) {
            return back()->withErrors('Quantidade insuficiente em estoque.');
        }
 // Subtrai a quantidade do estoque do produto
        $produto->estoque -= $request->quantidade;
        $produto->save();
  // Calcula o valor total da baixa (quantidade * valor unitário)
        $valor_total = $request->quantidade * $produto->valor_unitario;

        $baixa = Baixa::create([
            'cliente_id' => $request->cliente_id,
            'produto_id' => $request->produto_id,
            'quantidade' => $request->quantidade,
            'valor_total' => $valor_total,
            'data_hora' => now(),
        ]);
 // Gera o QR Code com as informações da baixa (cliente, produto, quantidade e total)
        $qrCode = QrCode::size(200)->generate("Cliente: {$baixa->cliente->nome}, Produto: {$baixa->produto->nome}, Quantidade: {$baixa->quantidade}, Total: R$ {$baixa->valor_total}");

        return view('baixas.show', compact('baixa', 'qrCode'));
    }
}