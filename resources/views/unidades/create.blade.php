@extends('layouts.app')

@section('title', 'Adicionar Unidade de Medida')

@section('content')
    <h1 class="mb-4">Adicionar Unidade de Medida</h1>

    <form action="{{ route('unidades.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="abreviatura" class="form-label">Abreviatura</label>
            <input type="text" name="abreviatura" id="abreviatura" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('unidades.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
