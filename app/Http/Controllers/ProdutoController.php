<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\UnidadeDeMedida;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos')); 
    }

    public function create()
    {
        $unidades = UnidadeDeMedida::all();
        $categorias = Categoria::all();

        return view('produtos.create', compact('unidades', 'categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'caminho' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'unidade_de_medida_id' => 'required|exists:unidades_de_medida,id',
            'categoria_id' => 'required|exists:categorias,id',
            'quantidade' => 'required|integer',
            'estoque' => 'required|integer',
            'descricao' => 'required|string',
            'valor_unitario' => 'required|numeric',
        ]);
    
        // Formato do valor unitário
        $valor_unitario = str_replace(',', '.', $request->valor_unitario);
    
        if ($request->hasFile('caminho')) {
            $path = $request->file('caminho')->store('produtos', 'public');
        }
    
        $produto = Produto::create([
            'nome' => $request->nome,
            'caminho' => $path ?? '', 
            'unidade_de_medida_id' => $request->unidade_de_medida_id,
            'categoria_id' => $request->categoria_id,
            'quantidade' => $request->quantidade,
            'estoque' => $request->estoque,
            'descricao' => $request->descricao,
            'valor_unitario' => $valor_unitario,
        ]);
    
        if ($produto) {
            \Log::info('Produto criado com sucesso.');
        } else {
            \Log::error('Falha ao criar produto.');
        }
    
        return redirect()->route('produtos.index');
    }
    
    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::all();
        $unidades = UnidadeDeMedida::all();
        return view('produtos.edit', compact('produto', 'categorias', 'unidades'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'caminho' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'unidade_de_medida_id' => 'required|exists:unidades_de_medida,id',
            'categoria_id' => 'required|exists:categorias,id',
            'quantidade' => 'required|integer',
            'estoque' => 'required|integer',
            'descricao' => 'required|string',
            'valor_unitario' => 'required|numeric',
        ]);

        if ($request->hasFile('caminho')) {
            $path = $request->file('caminho')->store('produtos', 'public');
            $produto->update(['caminho' => $path]);
        }

        $produto->update($request->except('caminho'));

        return redirect()->route('produtos.index');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index');
    }
}

