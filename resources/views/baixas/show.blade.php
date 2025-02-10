<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Baixa Registrada') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="mb-4">Baixa Registrada</h1>

                    <p><strong>Cliente:</strong> {{ $baixa->cliente->nome }}</p>
                    <p><strong>Produto:</strong> {{ $baixa->produto->nome }}</p>
                    <p><strong>Quantidade:</strong> {{ $baixa->quantidade }}</p>
                    <p><strong>Valor Total:</strong> R$ {{ $baixa->valor_total }}</p>
                    <p><strong>Data e Hora:</strong> {{ $baixa->data_hora }}</p>

                    <div>
                        <h3>QR Code:</h3>
                         <!-- Exibindo o QR code gerado -->
                        {!! $qrCode !!}
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('baixas.create') }}" class="btn btn-secondary">Registrar Nova Baixa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
