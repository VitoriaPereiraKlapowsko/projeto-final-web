@extends('layouts.app')

@section('title', 'Lista de Clientes')

@section('content')
<h1 class="mb-4">Lista de Clientes</h1>

<form action="{{ route('clientes.index') }}" method="GET" class="d-flex mb-4">
    <input type="text" name="nome" class="form-control me-2" placeholder="Filtrar nome do cliente"
        value="{{ request('nome') }}">
    <button type="submit" class="btn btn-secondary">Filtrar</button>
</form>

<div class="d-flex justify-content-start align-items-center mb-4">
    <a href="{{ route('clientes.create') }}" class="btn btn-success me-2">+ Novo Cliente</a>
    <a href="{{ route('categorias.create') }}" class="btn btn-info me-2">+ Adicionar Categoria</a>
    <a href="{{ route('unidades.create') }}" class="btn btn-secondary me-3">+ Adicionar Unidade de Medida</a>
    <a href="{{ route('produtos.create') }}" class="btn btn-primary me-3">+ Adicionar Produto</a>
    <a href="{{ route('baixas.create') }}" class="btn btn-dark me-3">Baixa no Estoque</a>
    <a href="{{ route('relatorios.retiradas_periodo', ['periodo' => 'diario']) }}" class="btn btn-primary me-2">Retiradas por Período</a>
    <a href="{{ route('relatorios.retiradas_por_cliente') }}" class="btn btn-warning me-2">Retiradas por Cliente</a>
    <a href="{{ route('relatorios.produtos_sem_estoque') }}" class="btn btn-danger me-2">Produtos sem Estoque</a>
    <a href="{{ route('relatorios.produtos_com_estoque') }}" class="btn btn-success me-2">Produtos com Estoque</a>
</div>

<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($clientes as $cliente)
            <tr>
                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->telefone }}</td>
                <td>{{ $cliente->cpf }}</td>
                <td>{{ $cliente->email }}</td>
                <td>
                    <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Deseja excluir este cliente?')">Excluir</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Nenhum cliente encontrado...</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection