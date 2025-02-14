<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Relatório de Produtos com Estoque') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Relatório de Produtos com Estoque</h1>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Unidade</th>
                                <th>Categoria</th>
                                <th>Estoque</th>
                                <th>% Restante em relação ao estoque inicial</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produtos as $produto)
                                <tr>
                                    <td>{{ $produto->nome }}</td>
                                    <td>{{ $produto->unidadeDeMedida->abreviatura ?? 'Sem Unidade' }}</td>
                                    <td>{{ $produto->categoria->nome }}</td>
                                    <td>{{ $produto->estoque }}</td>
                                     <!-- umber_format formata a forma como o número vai aparecer -->
                                    <td>{{ number_format($produto->percentual, 2, ',', '.') }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('relatorios.produtos_com_estoque.pdf') }}" class="btn btn-danger">Exportar PDF</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
