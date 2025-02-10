<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Relatório de Produtos sem Estoque') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Relatório de Produtos sem Estoque</h1>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Unidade</th>
                                <th>Categoria</th>
                                <th>Data em que o estoque findou</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produtos as $produto)
                                <tr>
                                    <td>{{ $produto->nome }}</td>
                                    <td>{{ $produto->unidadeDeMedida->abreviatura ?? 'Sem Unidade' }}</td>
                                    <td>{{ $produto->categoria->nome }}</td>
                                     <!-- format('d/m/Y H:i') formata a data para o formato 'dia/mês/ano hora:minuto' -->
                                    <td>{{ \Carbon\Carbon::parse($produto->data_estoque_zero)->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('relatorios.produtos_sem_estoque.pdf') }}" class="btn btn-danger">Exportar PDF</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
