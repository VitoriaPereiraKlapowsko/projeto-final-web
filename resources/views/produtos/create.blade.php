@extends('layouts.app')

@section('title', 'Adicionar Produto')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Adicionar Produto</h1>

    <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-4">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="mb-4">
            <label for="caminho" class="form-label">Imagem</label>
            <input type="file" class="form-control" id="caminho" name="caminho" required>
        </div>

        <div class="mb-3">
            <label for="unidade_de_medida_id" class="form-label">Unidade de Medida</label>
            <select class="form-control" id="unidade_de_medida_id" name="unidade_de_medida_id" required>
                @foreach($unidades as $unidade)
                    <option value="{{ $unidade->id }}">{{ $unidade->descricao }} ({{ $unidade->abreviatura }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="categoria_id" class="form-label">Categoria</label>
            <select class="form-control" id="categoria_id" name="categoria_id" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" required>
        </div>

        <div class="mb-4">
            <label for="estoque" class="form-label">Estoque</label>
            <input type="number" class="form-control" id="estoque" name="estoque" required>
        </div>

        <div class="mb-4">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="4" required></textarea>
        </div>

        <div class="mb-4">
            <label for="valor_unitario" class="form-label">Valor Unitário</label>
            <input type="text" class="form-control" id="valor_unitario" name="valor_unitario" required>
        </div>

        <script>
            document.getElementById('valor_unitario').addEventListener('input', function (event) {
                let value = event.target.value.replace(/[^\d,]/g, '').replace(',', '.');
                value = parseFloat(value).toFixed(2);
                event.target.value = value.replace('.', ',');
            });
        </script>


        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection