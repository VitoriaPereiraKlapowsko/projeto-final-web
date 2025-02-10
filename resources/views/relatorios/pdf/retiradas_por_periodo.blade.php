<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Relatório de Retiradas por Período') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Relatório de Retiradas por {{ ucfirst($periodo) }}</h1>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Período</th>
                                <th>Nome do Produto</th>
                                <th>Quantidade Retirada</th>
                                <th>Unidade</th>
                                <th>Categoria</th>
                                <th>Cliente</th>
                                <th>Data da Retirada</th>
                                <th>Valor Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($retiradas as $retirada)
                                <tr>
                                    <td>{{ $retirada->periodo }}</td>
                                    <td>{{ $retirada->produto->nome }}</td>
                                    <td>{{ $retirada->total }}</td>
                                    <td>{{ $retirada->produto->unidadeDeMedida->abreviatura ?? 'N/A' }}</td>
                                    <td>{{ $retirada->produto->categoria->nome ?? 'N/A' }}</td>
                                    <td>{{ $retirada->cliente->nome }}</td>
                                    <td>{{ \Carbon\Carbon::parse($retirada->data_retirada)->format('d/m/Y H:i') }}</td>
                                    <td>R$ {{ number_format($retirada->valor_total, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('relatorios.retiradas_periodo', ['periodo' => 'diario']) }}" class="btn btn-primary">Diário</a>
                        <a href="{{ route('relatorios.retiradas_periodo', ['periodo' => 'semanal']) }}" class="btn btn-primary">Semanal</a>
                        <a href="{{ route('relatorios.retiradas_periodo', ['periodo' => 'mensal']) }}" class="btn btn-primary">Mensal</a>
                        <!--Periodo como parâmetro permite que o relatório seja gerado de acordo com a escolha do usuário-->
                        <a href="{{ route('relatorios.retiradas_periodo.pdf', ['periodo' => $periodo]) }}" class="btn btn-danger">Exportar PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
