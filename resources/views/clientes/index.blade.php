@extends('layouts.app')

@section('title', 'Lista de Clientes')

@section('content')
    <h1 class="mb-4">Lista de Clientes</h1>

    <form action="{{ route('clientes.index') }}" method="GET" class="d-flex mb-4">
        <input type="text" name="nome" class="form-control me-2" placeholder="Filtrar nome do cliente" value="{{ request('nome') }}">
        <button type="submit" class="btn btn-secondary">Filtrar</button>
    </form>

    <a href="{{ route('clientes.create') }}" class="btn btn-success mb-3">+ Novo Cliente</a>

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
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir este cliente?')">Excluir</button>
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
