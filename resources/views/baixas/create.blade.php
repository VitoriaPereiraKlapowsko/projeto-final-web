<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registrar Baixa no Estoque') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="mb-4">Registrar Baixa no Estoque</h1>
                    <form action="{{ route('baixas.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                             <!-- Seletor de Cliente -->
                            <label for="cliente_id" class="form-label">Cliente</label>
                            <select class="form-control" id="cliente_id" name="cliente_id" required>
                                 <!-- Iterando sobre os clientes e criando as opções -->
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <!-- Seletor de Produto -->
                            <label for="produto_id" class="form-label">Produto</label>
                            <select class="form-control" id="produto_id" name="produto_id" required>
                                <!-- Iterando sobre os produtos e criando as opções -->
                                @foreach($produtos as $produto)
                                    <option value="{{ $produto->id }}">{{ $produto->nome }} (Estoque: {{ $produto->estoque }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="quantidade" class="form-label">Quantidade</label>
                            <input type="number" class="form-control" id="quantidade" name="quantidade" required>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-primary">Registrar Baixa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
