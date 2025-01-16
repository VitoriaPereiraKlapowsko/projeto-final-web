<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnidadeDeMedida;

class UnidadeDeMedidaController extends Controller
{
    public function index()
    {
        $unidades = UnidadeDeMedida::all();
        return view('unidades.index', compact('unidades'));
    }

    public function create()
    {
        return view('unidades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'abreviatura' => 'required|string|max:10|unique:unidades_de_medida,abreviatura',
            'descricao' => 'required|string|max:255',
        ]);

        UnidadeDeMedida::create($request->all());
        return redirect()->route('unidades.index')->with('success', 'Unidade de medida criada com sucesso!');
    }

    public function edit($id)
    {
        $unidade = UnidadeDeMedida::findOrFail($id);
        return view('unidades.edit', compact('unidade'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'abreviatura' => 'required|string|max:10|unique:unidades_de_medida,abreviatura,' . $id,
            'descricao' => 'required|string|max:255',
        ]);

        $unidade = UnidadeDeMedida::findOrFail($id);
        $unidade->update($request->all());

        return redirect()->route('unidades.index')->with('success', 'Unidade de medida atualizada com sucesso!');
    }

    public function destroy($id)
    {
        UnidadeDeMedida::destroy($id);
        return redirect()->route('unidades.index')->with('success', 'Unidade de medida excluída com sucesso!');
    }
}