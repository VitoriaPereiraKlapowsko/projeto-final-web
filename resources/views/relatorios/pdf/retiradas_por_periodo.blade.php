@extends('layouts.app')

@section('title', 'Relatório de Retiradas por Período')

@section('content')
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

<a href="{{ route('relatorios.retiradas_periodo', ['periodo' => 'diario']) }}" class="btn btn-primary">Diário</a>
<a href="{{ route('relatorios.retiradas_periodo', ['periodo' => 'semanal']) }}" class="btn btn-primary">Semanal</a>
<a href="{{ route('relatorios.retiradas_periodo', ['periodo' => 'mensal']) }}" class="btn btn-primary">Mensal</a>
<a href="{{ route('relatorios.retiradas_periodo.pdf', ['periodo' => $periodo]) }}" class="btn btn-danger">Exportar PDF</a>

@endsection
