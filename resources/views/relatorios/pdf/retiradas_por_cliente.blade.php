<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Relatório de Retiradas por Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Relatório de Retiradas por Cliente</h1>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Produto</th>
                                <th>Unidade</th>
                                <th>Categoria</th>
                                <th>Quantidade Retirada</th>
                                <th>Data da Retirada</th>
                                <th>Valor Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($retiradas as $retirada)
                                <tr>
                                    <td>{{ $retirada->cliente->nome }}</td>
                                    <td>{{ $retirada->produto->nome }}</td>
                                    <!--Aqui caso não tenha nenhuma unidade de medida cadastrada aí aparece o "Sem Unidade"-->
                                    <td>{{ $retirada->produto->unidadeDeMedida->abreviatura ?? 'Sem Unidade' }}</td>
                                    <td>{{ $retirada->produto->categoria->nome }}</td>
                                    <td>{{ $retirada->total }}</td>
                                    <!--Formatando data e casas decimais do números-->
                                    <td>{{ \Carbon\Carbon::parse($retirada->data_retirada)->format('d/m/Y') }}</td>
                                    <td>R$ {{ number_format($retirada->valor_total, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('relatorios.retiradas_por_cliente.pdf') }}" class="btn btn-danger">Exportar PDF</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
