<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="mb-4">Lista de Clientes</h1>

                    <form action="{{ route('clientes.index') }}" method="GET" class="d-flex mb-4">
                        <input type="text" name="nome" class="form-control me-2" placeholder="Filtrar nome do cliente"
                            value="{{ request('nome') }}">
                        <button type="submit" class="btn btn-secondary">Filtrar</button>
                    </form>

                    <div class="row mb-4">
                        <div class="col-12 col-md-4 mb-2">
                            <a href="{{ route('clientes.create') }}" class="btn btn-success w-100">+ Novo Cliente</a>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <a href="{{ route('categorias.create') }}" class="btn btn-info w-100">+ Adicionar Categoria</a>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <a href="{{ route('unidades.create') }}" class="btn btn-secondary w-100">+ Adicionar Unidade de Medida</a>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <a href="{{ route('produtos.create') }}" class="btn btn-primary w-100">+ Adicionar Produto</a>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <a href="{{ route('baixas.create') }}" class="btn btn-dark w-100">Baixa no Estoque</a>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <a href="{{ route('relatorios.retiradas_periodo') }}" class="btn btn-primary w-100">Retiradas por Período</a>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <a href="{{ route('relatorios.retiradas_por_cliente') }}" class="btn btn-warning w-100">Retiradas por Cliente</a>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <a href="{{ route('relatorios.produtos_sem_estoque') }}" class="btn btn-danger w-100">Produtos sem Estoque</a>
                        </div>
                        <div class="col-12 col-md-4 mb-2">
                            <a href="{{ route('relatorios.produtos_com_estoque') }}" class="btn btn-success w-100">Produtos com Estoque</a>
                        </div>
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
                                <tr> <!-- Exibindo o cliente -->
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
