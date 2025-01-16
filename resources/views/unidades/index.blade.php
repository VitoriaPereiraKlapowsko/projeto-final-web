@extends('layouts.app')

@section('title', 'Unidades de Medida')

@section('content')
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
@endsection
