<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request){
        $nome = $request->query('nome');

        // Busca clientes pelo nome (se existir um filtro)
        if ($nome) {
            $clientes = Cliente::where('nome', 'like', '%' . $nome . '%')->get();
        } else {
            $clientes = Cliente::all(); // Sem filtro, busca tudo
        }
        return view('clientes.index', compact('clientes'));
    }

    public function create(){
        return view('clientes.create');
    }

    public function store(Request $request){
    $request->validate([
        'nome' => 'required|string|max:255',
        'telefone' => 'required|string|max:15',
        'cpf' => 'required|string|size:11|unique:clientes,cpf',
        'email' => 'required|email|max:255|unique:clientes,email',
        'cep' => 'required|string|size:8',
        'numero' => 'required|string',
        'rua' => 'required|string',
        'bairro' => 'required|string',
        'cidade' => 'required|string',
        'estado' => 'required|string',
    ]);

    $cliente = Cliente::create($request->only(['nome', 'telefone', 'cpf', 'email']));
    $cliente->endereco()->create($request->only(['cep', 'rua', 'bairro', 'cidade', 'estado', 'numero', 'complemento']));
    
    return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
}

    public function show(string $id) {
        //
    }

    public function edit($id){
        $cliente = Cliente::with('endereco')->findOrFail($id);
        
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:clientes,email,' . $id,
            'cep' => 'required|string|size:8',
            'numero' => 'required|string',
            'rua' => 'required|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'estado' => 'required|string',
        ]);

        // Atualizar Cliente
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->only(['nome', 'telefone', 'email']));

        // Atualizar Endereço
        $cliente->endereco->update($request->only(['cep', 'rua', 'bairro', 'cidade', 'estado', 'numero', 'complemento']));

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy($id){
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }
}
