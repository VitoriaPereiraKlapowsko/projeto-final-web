<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="mb-4">Editar Cliente</h1>
                    <form method="POST" action="{{ route('clientes.update', $cliente->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="{{ $cliente->nome }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="text" name="telefone" id="telefone" class="form-control" value="{{ $cliente->telefone }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" name="cpf" id="cpf" class="form-control" value="{{ $cliente->cpf }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $cliente->email }}" required>
                            </div>
                        </div>

                        <h2 class="mt-4">Endereço</h2>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" name="cep" id="cep" class="form-control" value="{{ $cliente->endereco->cep }}" required onblur="buscarCEP(this.value)">
                            </div>
                            <div class="col-md-6">
                                <label for="rua" class="form-label">Rua</label>
                                <input type="text" name="rua" id="rua" class="form-control" value="{{ $cliente->endereco->rua }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" name="bairro" id="bairro" class="form-control" value="{{ $cliente->endereco->bairro }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" name="cidade" id="cidade" class="form-control" value="{{ $cliente->endereco->cidade }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="estado" class="form-label">Estado</label>
                                <input type="text" name="estado" id="estado" class="form-control" value="{{ $cliente->endereco->estado }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" name="numero" id="numero" class="form-control" value="{{ $cliente->endereco->numero }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input type="text" name="complemento" id="complemento" class="form-control" value="{{ $cliente->endereco->complemento }}">
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            function buscarCEP(cep) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())// Converte a resposta da requisição para JSON
                    .then(data => {// Preenche os campos do formulário com os dados retornados pela API
                // Preenche o campo "rua" com o logradouro
                        document.querySelector('#rua').value = data.logradouro;
                        document.querySelector('#bairro').value = data.bairro;
                        document.querySelector('#cidade').value = data.localidade;
                        document.querySelector('#estado').value = data.uf;
                    });
            }
        </script>
    </x-slot>
</x-app-layout>
