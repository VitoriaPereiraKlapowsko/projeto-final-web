<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Unidades de Medida') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="mb-4">Unidades de Medida</h1>

                    <a href="{{ route('unidades.create') }}" class="btn btn-success mb-3">+ Nova Unidade</a>

                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Abreviatura</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($unidades as $unidade)
                                <tr>
                                    <td>{{ $unidade->abreviatura }}</td>
                                    <td>{{ $unidade->descricao }}</td>
                                    <td>
                                        <a href="{{ route('unidades.edit', $unidade) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('unidades.destroy', $unidade) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir esta unidade?')">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
