@extends('layouts.app')

@section('title', 'Relatório de Produtos com Estoque')

@section('content')
<h1>Relatório de Produtos com Estoque</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Produto</th>
            <th>Unidade</th>
            <th>Categoria</th>
            <th>Quantidade</th>
            <th>% Restante em relação ao estoque inicial</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produtos as $produto)
            <tr>
                <td>{{ $produto->nome }}</td>
                <td>{{ $produto->unidadeDeMedida->abreviatura ?? 'Sem Unidade' }}</td>
                <td>{{ $produto->categoria->nome }}</td>
                <td>{{ $produto->quantidade }}</td>
                <td>{{ number_format($produto->percentual, 2, ',', '.') }}%</td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('relatorios.produtos_com_estoque.pdf') }}" class="btn btn-danger">Exportar PDF</a>
@endsection
