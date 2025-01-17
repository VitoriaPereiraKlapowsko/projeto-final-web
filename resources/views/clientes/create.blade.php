@extends('layouts.app')

@section('title', 'Adicionar Cliente')

@section('content')
<h1>Novo Cliente</h1>
<form action="{{ route('clientes.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>

    <div class="mb-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" class="form-control" id="telefone" name="telefone" required>
    </div>

    <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" class="form-control" id="cpf" name="cpf" required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
        <label for="cep" class="form-label">CEP</label>
        <input type="text" class="form-control" id="cep" name="cep" required>
    </div>

    <div class="mb-3">
        <label for="rua" class="form-label">Rua</label>
        <input type="text" class="form-control" id="rua" name="rua">
    </div>

    <div class="mb-3">
        <label for="bairro" class="form-label">Bairro</label>
        <input type="text" class="form-control" id="bairro" name="bairro">
    </div>

    <div class="mb-3">
        <label for="cidade" class="form-label">Cidade</label>
        <input type="text" class="form-control" id="cidade" name="cidade" readonly>
    </div>

    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <input type="text" class="form-control" id="estado" name="estado" readonly>
    </div>

    <div class="mb-3">
        <label for="numero" class="form-label">Número</label>
        <input type="text" class="form-control" id="numero" name="numero" required>
    </div>

    <div class="mb-3">
        <label for="complemento" class="form-label">Complemento</label>
        <input type="text" class="form-control" id="complemento" name="complemento">
    </div>

    <div class="d-flex justify-content-center mt-4">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>

<script>
    // Adiciona um evento de "blur" ao campo de entrada de CEP.
    // O evento "blur" é acionado quando o campo perde o foco.
    document.getElementById('cep').addEventListener('blur', function () {
        const cep = this.value.replace(/\D/g, '');   // Remove todos os caracteres que não são números do valor do campo de CEP.

        if (cep.length === 8) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`)// Faz uma requisição para a API ViaCEP com o CEP digitado.
                .then(response => response.json())// Converte a resposta da API para JSON.
                .then(data => {
                    if (!data.erro) { // Verifica se a API retornou dados válidos (sem erro).
                        document.getElementById('rua').value = data.logradouro; // Exibe uma mensagem de alerta se o CEP não for encontrado.
                        document.getElementById('bairro').value = data.bairro;
                        document.getElementById('cidade').value = data.localidade;
                        document.getElementById('estado').value = data.uf;
                    } else {
                        alert('CEP não encontrado.');
                    }
                })
                .catch(() => alert('Erro ao buscar o CEP.'));
        } else {
            alert('CEP inválido.');
        }
    });
</script>
@endsection