@extends('layouts.app')

@section('title', 'Relatório de Produtos sem Estoque')

@section('content')
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
                <td>{{ \Carbon\Carbon::parse($produto->data_estoque_zero)->format('d/m/Y H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('relatorios.produtos_sem_estoque.pdf') }}" class="btn btn-danger">Exportar PDF</a>
@endsection
