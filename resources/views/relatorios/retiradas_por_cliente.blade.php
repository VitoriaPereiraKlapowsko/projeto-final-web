@extends('layouts.app')

@section('title', 'Relatório de Retiradas por Cliente')

@section('content')
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
                <td>{{ $retirada->produto->unidadeDeMedida->nome ?? 'Sem Unidade' }}</td>
                <td>{{ $retirada->produto->categoria->nome }}</td>
                <td>{{ $retirada->total }}</td>
                <td>{{ \Carbon\Carbon::parse($retirada->data_retirada)->format('d/m/Y') }}</td>
                <td>R$ {{ number_format($retirada->valor_total, 2, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
