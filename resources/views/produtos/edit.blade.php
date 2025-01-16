@extends('layouts.app')

@section('title', 'Editar Produto')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Editar Produto</h1>

        <form action="{{ route('produtos.update', $produto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $produto->nome) }}" required>
            </div>

            <div class="mb-4">
                <label for="caminho" class="form-label">Imagem</label>
                <input type="file" name="caminho" id="caminho" class="form-control">
                <small class="text-muted">Deixe em branco para manter a imagem atual.</small>
            </div>

            <div class="mb-4">
                <label for="unidade_de_medida_id" class="form-label">Unidade de Medida</label>
                <select name="unidade_de_medida_id" id="unidade_de_medida_id" class="form-control" required>
                    @foreach($unidades as $unidade)
                        <option value="{{ $unidade->id }}" {{ $produto->unidade_de_medida_id == $unidade->id ? 'selected' : '' }}>
                            {{ $unidade->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="categoria_id" class="form-label">Categoria</label>
                <select name="categoria_id" id="categoria_id" class="form-control" required>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ $produto->categoria_id == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="quantidade" class="form-label">Quantidade</label>
                <input type="number" name="quantidade" id="quantidade" class="form-control" value="{{ old('quantidade', $produto->quantidade) }}" required>
            </div>

            <div class="mb-4">
                <label for="estoque" class="form-label">Estoque</label>
                <input type="number" name="estoque" id="estoque" class="form-control" value="{{ old('estoque', $produto->estoque) }}" required>
            </div>

            <div class="mb-4">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea name="descricao" id="descricao" class="form-control" rows="4" required>{{ old('descricao', $produto->descricao) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="valor_unitario" class="form-label">Valor Unitário</label>
                <input type="number" step="0.01" name="valor_unitario" id="valor_unitario" class="form-control" value="{{ old('valor_unitario', $produto->valor_unitario) }}" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
