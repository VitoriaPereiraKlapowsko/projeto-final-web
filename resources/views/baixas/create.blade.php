@extends('layouts.app')

@section('title', 'Registrar Baixa')

@section('content')
<h1>Registrar Baixa no Estoque</h1>

<form action="{{ route('baixas.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="cliente_id" class="form-label">Cliente</label>
        <select class="form-control" id="cliente_id" name="cliente_id" required>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="produto_id" class="form-label">Produto</label>
        <select class="form-control" id="produto_id" name="produto_id" required>
            @foreach($produtos as $produto)
                <option value="{{ $produto->id }}">{{ $produto->nome }} (Estoque: {{ $produto->estoque }})</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="quantidade" class="form-label">Quantidade</label>
        <input type="number" class="form-control" id="quantidade" name="quantidade" required>
    </div>

    <button type="submit" class="btn btn-primary">Registrar Baixa</button>
</form>
@endsection
